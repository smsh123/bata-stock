<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Customer;
use App\Models\Sell;
use PDF;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $token = null;
        $input = ['email'=>$user->email, 'password'=>'12345678'];
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user->jwt_token=$token;
        $user->save();
        session(['token' => $token]);
        $articles=Articles::all();
        $last_bill_no=Sell::latest()->first();
        return view('home')->with(["user"=>$user,'articles'=>$articles,'last_bill_no' => $last_bill_no->bill_no]);
        // return $user;
    }

    public function AddStock()
    {
        return view('addstock');
    }
    public function InsertStock(Request $request)
    {
        $data=$request->input();
        $articles = Articles::updateOrCreate(
            ['article_no'=> $data['articalNumber']],
            ['article_type'=> $data['articalType'],
             'article_no'=> $data['articalNumber'],
             'age_group'=> $data['ageGroup'],
              's_1'=> $data['size_1'],
              's_2'=> $data['size_2'],
               's_3'=> $data['size_3'],
                's_4'=> $data['size_4'],
                 's_5'=> $data['size_5'],
                 's_6'=> $data['size_6'],
                  's_7'=> $data['size_7'],
                   's_8'=> $data['size_8'],
                    's_9'=> $data['size_9'],
                     's_10'=> $data['size_10'],
                      's_11'=> $data['size_11'],
                       's_12'=> $data['size_12'],
                        's_13'=> $data['size_13'],
                         'price'=> $data['price']]
        );
        $request->session()->put('status', 'Article added Successfully');
        return redirect('stock');
    }
    public function Stock()
    {
        $stock_all=Articles::all();
        return view('stock')->with(["stock_all"=>$stock_all]);
    }
    public function Sell()
    {
        $sells=Sell::all();
        return view('sells')->with(["sells"=>$sells]);
    }
    public function Customers()
    {
        $customers=Customer::all();
        foreach ($customers as $key => $customer) {
            $customer->all_order=Sell::where('cust_mobile','=',$customer->mobile)->get()->count();
        }
        return view('customers')->with(["customers"=>$customers]);
    }
    public function Bill(Request $request,$bill_no)
    {
        $bill=Sell::where('bill_no','=',$bill_no)->get()->first();
        $article_no = json_decode($bill->article_no);
        $article_size = json_decode($bill->article_size);
        $quantity = json_decode($bill->quantity);
        $article_price = json_decode($bill->article_price);
        for ($i=0; $i < count($article_no) ; $i++) { 
            $item['article_no']=$article_no[$i]; 
            $item['article_size']=$article_size[$i]; 
            $item['quantity']=$quantity[$i]; 
            $item['article_price']=$article_price[$i];  
            $items[$i]=(object) $item;
        }
        $items= (object) $items;
        // return $bill;
        return view('bill')->with(["bill"=>$bill,'items'=>$items]);
    }


    public function insertBill(Request $request){
        $articles = Customer::updateOrCreate(
        ['mobile'=> $request->cust_mobile],
        [
            'name' => $request->cust_name,
            'mobile'=> $request->cust_mobile
        ]   
        );
        $sell = Sell::Create(
            ['bill_no' =>$request->bill_no,
             'cust_name' =>$request->cust_name,
              'cust_mobile' =>$request->cust_mobile,
               'txnNo' =>$request->txnNo,
                'article_no' => json_encode($request->article_no),
                 'article_size' =>json_encode($request->article_size),
                  'quantity' =>json_encode($request->quantity),
                   'article_price' =>json_encode($request->article_price),
                    'total_price' =>$request->total_price
                    ]
            );
            $bill_index=$sell->bill_no;
        // return $request;
        return redirect('/bill/'.$bill_index);
    }

    // Generate PDF
    public function createPDF() {
        // retreive all records from db
        $stock_all=Articles::all();
  
        // share data to view
        view()->share('stock_all',$stock_all);
        $pdf = PDF::loadView('pdfview', $stock_all);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }
}
