<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Product;
use App\Notification\NewProductNoti;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class NewProductNotiCommand extends Command
{


    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification';

    /**
     * Execute the console command.
     *
     * @return mixed Command-line output
     */
    public function handle()
    {
        $today    = Carbon::today();
        $products = Product::whereDate('created_at', $today)->get();
        if (empty($products->toArray())) {
          return $this->info('Không có sản phẩm mới nào');
        }
        $users = Customer::get();
        foreach ($users as $user) {
            $userSchema = Customer::where('email', $user->email)->first();
            Notification::send($userSchema, new NewProductNoti($products, $today));
        $this->info('Đang gửi mail người dùng: '.$user->name);
        }
        $this->info('Gửi mail hoàn tất');
    }
}
