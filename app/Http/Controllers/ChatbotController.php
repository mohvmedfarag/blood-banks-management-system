<?php
namespace App\Http\Controllers;

use App\Models\BloodSample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{

    public function chat(){
        return view('chat');
    }

    public function handle(Request $request)
    {
        // اسم المستخدم (مريض أو متبرع)
        $name = Auth::guard('patient')->check()
            ? Auth::guard('patient')->user()->name
            : Auth::guard('donor')->user()->name;
    
        $message = trim($request->input('message'));
        $lower   = mb_strtolower($message);
    
        // 1) البحث عن الكلمات المفتاحية «محتاج» أو «عينة» + فصيلة دم
        if ((str_contains($lower, 'محتاج') || str_contains($lower, 'عينة')) 
            && preg_match('/([abo]{1,2}[+-])/i', $message, $m)
        ) {
            $type = strtoupper($m[1]); // مثلاً "A+"
    
            // جلب بنوك الدم التي تحتوي هذه العينة
            $banks = BloodSample::where('blood-sample', $type)
                ->with('bloodbank')
                ->get()
                ->pluck('bloodbank.name')
                ->unique()
                ->toArray();
    
            if (count($banks)) {
                $list = implode(' and ', $banks);
                $response = "عزيزي {$name}،<br> عينة الدم “{$type}” متوفرة في بنوك الدم التالية: {$list}.";
            } else {
                $response = "عزيزي {$name}،<br> لا توجد حالياً بنوك دم متوفرة بها عينة “{$type}”.";
            }
    
        }
        // 2) التسجيل: «تسجيل» أو «حساب جديد»
        elseif (str_contains($lower, 'تسجيل') || str_contains($lower, 'حساب جديد')) {
            $response = "عزيزي {$name}،<br> يمكنك إنشاء حساب جديد من خلال الضغط على زر \"تسجيل\" في القائمة الرئيسية.";
        }
        // 3) شروط التبرع: «وزن» أو «عمر» أو «شرط»
        elseif (str_contains($lower, 'وزن') || str_contains($lower, 'عمر') || str_contains($lower, 'شرط')) {
            $response = "عزيزي {$name}،<br> للتبرع يجب أن يكون عمرك بين 18 و60 سنة ووزنك لا يقل عن 50 كجم، وأن تكون بصحة جيدة.";
        }
        // 4) مكان أقرب بنك: «فين» أو «مكان» أو «أقرب»
        elseif (str_contains($lower, 'فين') || str_contains($lower, 'مكان') || str_contains($lower, 'أقرب')) {
            $response = "عزيزي {$name}،<br> يمكنك معرفة أقرب بنوك الدم من خلال صفحة \"البنوك\"،  استخدم الخريطة لاختيار الأنسب. او اكتب في البحث المحافظة او المدينة الموجود فيها ";
        }
        // 5) حالة الطلب: «حالة» أو «متابعة» أو «طلب»
        elseif (str_contains($lower, 'حالة') || str_contains($lower, 'متابعة') || str_contains($lower, 'طلب')) {
            $response = "عزيزي {$name}،<br> لمتابعة حالة طلبك اذهب إلى لوحة التحكم ثم إلى \"طلباتي\"، وستجد جميع التفاصيل.";
        }
        // 6) الردود الإنجليزية كما كانت
        elseif (str_contains($lower, 'how can i request blood')) {
            $response = "Dear {$name}, you can request blood by going to the 'New Request' page.";
        }
        elseif (str_contains($lower, 'where is the nearest blood bank')) {
            $response = "Dear {$name}, check the 'Blood Banks' page and use the map to find the nearest one.";
        }
        elseif (str_contains($lower, 'how often can i donate blood')) {
            $response = "Dear {$name}, you can donate whole blood every 3 months. Consult your doctor if unsure.";
        }
        elseif (str_contains($lower, 'how do i know my donation was accepted')) {
            $response = "Dear {$name}, you will receive a notification on your dashboard once approved.";
        }
        elseif (str_contains($lower, 'is blood donation safe')) {
            $response = "Dear {$name}, yes—blood donation is safe. We use sterile equipment and follow guidelines.";
        }
        // 7) إفتراضي
        else {
            $response = "عفواً {$name}،<br> لم أفهم سؤالك، حاول صياغته بطريقة أخرى أو اختر من الأسئلة الشائعة.";
        }
    
        return response()->json($response);
    }
}
