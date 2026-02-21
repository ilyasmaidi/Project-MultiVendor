<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Message;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Stats
        $stats = [
            'total_ads' => $user->ads()->count(),
            'active_ads' => $user->ads()->where('status', 'active')->count(),
            'pending_ads' => $user->ads()->where('status', 'pending')->count(),
            'total_views' => $user->ads()->sum('views_count') ?? 0,
            'unread_messages' => $user->messages()->whereNull('read_at')->count(),
            'favorites_count' => $user->favorites()->count() ?? 0,
        ];
        
        // Recent ads
        $recentAds = $user->ads()
            ->with('category', 'images')
            ->latest()
            ->take(5)
            ->get();
        
        // Recent messages
        $recentMessages = $user->messages()
            ->with('sender', 'ad')
            ->whereNull('read_at')
            ->latest()
            ->take(5)
            ->get();
        
        // Recent activity
        $activity = $this->getRecentActivity($user);
        
        // Store stats for vendors
        $storeStats = null;
        if ($user->hasStore()) {
            $storeStats = [
                'store_views' => $user->store->views_count ?? 0,
                'store_ads' => $user->store->ads()->count(),
                'featured_ads' => $user->store->ads()->where('is_featured', true)->count(),
            ];
        }
        
        return view('dashboard.index', compact(
            'stats', 
            'recentAds', 
            'recentMessages', 
            'activity',
            'storeStats'
        ));
    }
    
    public function stats()
    {
        $user = auth()->user();
        
        // Get stats by month for charts
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $month->format('M'),
                'ads' => $user->ads()
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
                'views' => $user->ads()
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('views_count') ?? 0,
            ];
        }
        
        // Category breakdown
        $categoryStats = $user->ads()
            ->selectRaw('category_id, count(*) as count')
            ->with('category:id,name')
            ->groupBy('category_id')
            ->get();
        
        return view('dashboard.stats', compact('monthlyStats', 'categoryStats'));
    }
    
    public function activity()
    {
        $user = auth()->user();
        $activities = $this->getRecentActivity($user, 50);
        
        return view('dashboard.activity', compact('activities'));
    }
    
    private function getRecentActivity($user, $limit = 10)
    {
        $activities = [];
        
        // Recent ads
        $ads = $user->ads()
            ->select('id', 'title', 'status', 'created_at', 'updated_at')
            ->latest()
            ->take($limit)
            ->get();
        
        foreach ($ads as $ad) {
            $activities[] = [
                'type' => 'ad',
                'title' => $ad->title,
                'status' => $ad->status,
                'date' => $ad->created_at,
                'url' => route('ads.show', $ad->slug),
            ];
        }
        
        // Recent messages
        $messages = $user->messages()
            ->with('sender')
            ->latest()
            ->take($limit)
            ->get();
        
        foreach ($messages as $message) {
            $activities[] = [
                'type' => 'message',
                'title' => 'رسالة من ' . $message->sender->name,
                'status' => $message->read_at ? 'read' : 'unread',
                'date' => $message->created_at,
                'url' => route('messages.index'),
            ];
        }
        
        // Sort by date
        usort($activities, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });
        
        return array_slice($activities, 0, $limit);
    }
}
