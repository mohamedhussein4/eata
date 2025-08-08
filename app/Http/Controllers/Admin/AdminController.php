namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Donation;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\AdminNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // إحصائيات المشاريع
        $projects = Project::withCount(['donations'])
            ->withSum('donations', 'amount')
            ->get();
        
        $projectStats = [
            'total' => $projects->count(),
            'active' => $projects->where('status', 'active')->count(),
            'completed' => $projects->where('status', 'completed')->count(),
            'total_donations' => $projects->sum('donations_count'),
            'total_amount' => $projects->sum('donations_sum_amount'),
        ];

        // المشاريع النشطة
        $activeProjects = Project::where('status', 'active')
            ->withCount('donations')
            ->withSum('donations', 'amount')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($project) {
                $progress = $project->total_amount > 0 
                    ? ($project->donations_sum_amount / $project->total_amount) * 100 
                    : 0;
                
                return [
                    'title' => $project->title,
                    'description' => $project->description,
                    'category' => $project->category ?? 'عام',
                    'status_text' => $project->status === 'active' ? 'نشط' : 'مكتمل',
                    'status_color' => $project->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800',
                    'progress' => round($progress, 1),
                    'progress_color' => 'from-charity-500 to-charity-600',
                    'attachments_count' => 0,
                    'comments_count' => 0,
                    'team_members' => [],
                    'date_range' => $project->created_at->format('Y-m-d'),
                ];
            });

        // إحصائيات المستخدمين
        $userStats = [
            'total' => User::count(),
            'donors' => User::whereHas('donations')->count(),
            'volunteers' => Volunteer::count(),
            'beneficiaries' => User::where('type', 'beneficiary')->count(),
        ];

        // الإشعارات
        $notifications = AdminNotification::latest()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'icon' => 'fas fa-bell',
                    'icon_bg' => 'bg-charity-100',
                    'icon_color' => 'text-charity-600',
                    'time_ago' => $notification->created_at->diffForHumans(),
                ];
            });

        $unread_notifications_count = AdminNotification::where('read_at', null)->count();

        // معلومات التقويم
        $current_month = Carbon::now()->translatedFormat('F Y');

        // أعضاء الفريق
        $team_members = User::where('type', 'admin')
            ->take(5)
            ->get()
            ->map(function ($member) {
                return [
                    'name' => $member->name,
                    'role' => 'مدير',
                    'initials' => substr($member->name, 0, 2),
                    'avatar_bg' => 'bg-charity-600',
                    'status_color' => 'bg-green-500',
                ];
            });

        return view('admin.index', compact(
            'projectStats',
            'activeProjects',
            'userStats',
            'notifications',
            'unread_notifications_count',
            'current_month',
            'team_members'
        ));
    }
} 