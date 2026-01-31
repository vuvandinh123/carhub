@extends('layouts.app')

@section('title', 'Tính khoản vay mua xe - CarHub')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-green-600 via-emerald-700 to-teal-800 dark:from-gray-900 dark:via-green-900 dark:to-teal-900 py-20">
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    <div class="container mx-auto px-4 pb-20 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full mb-6">
                <i data-lucide="calculator" class="w-8 h-8 text-white"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tính toán khoản vay mua xe</h1>
            <p class="text-lg text-gray-200">
                Công cụ tính toán chi phí vay mua xe nhanh chóng, chính xác và miễn phí
            </p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" 
                  class="fill-white dark:fill-gray-900"/>
        </svg>
    </div>
</section>

<!-- Calculator Section -->
<section class="py-16 bg-white dark:bg-gray-900 -mt-1">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto">
            <!-- Calculator Form -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                    <i data-lucide="settings" class="w-6 h-6 mr-2 text-green-600 dark:text-green-400"></i>
                    Thông tin khoản vay
                </h2>

                <form id="loan-calculator-form" class="space-y-6">
                    <!-- Giá xe -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Giá xe (VNĐ)
                        </label>
                        <div class="relative">
                            <input type="text" id="car-price" value="500000000"
                                   class="block pr-14 w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-right font-semibold"
                                   placeholder="500,000,000">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">VNĐ</span>
                            </div>
                        </div>
                        <input type="range" id="car-price-slider" min="100000000" max="3000000000" step="10000000" value="500000000"
                               class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer mt-3">
                        <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span>100 triệu</span>
                            <span>3 tỷ</span>
                        </div>
                    </div>

                    <!-- Trả trước -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Trả trước (%)
                        </label>
                        <div class="relative">
                            <input type="number" id="down-payment-percent" value="20" min="0" max="100"
                                   class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-right font-semibold">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">%</span>
                            </div>
                        </div>
                        <input type="range" id="down-payment-slider" min="0" max="80" step="5" value="20"
                               class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer mt-3">
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Số tiền: <span id="down-payment-amount" class="font-semibold text-green-600 dark:text-green-400">100,000,000 VNĐ</span>
                        </div>
                    </div>

                    <!-- Lãi suất -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Lãi suất (%/năm)
                        </label>
                        <div class="relative">
                            <input type="number" id="interest-rate" value="9" min="1" max="30" step="0.1"
                                   class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-right font-semibold">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">%</span>
                            </div>
                        </div>
                        <input type="range" id="interest-rate-slider" min="1" max="20" step="0.5" value="9"
                               class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer mt-3">
                    </div>

                    <!-- Thời gian vay -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Thời gian vay (năm)
                        </label>
                        <div class="grid grid-cols-4 gap-3">
                            <button type="button" class="loan-term-btn py-3 px-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-400 transition-colors font-semibold text-gray-700 dark:text-gray-300" data-years="3">3 năm</button>
                            <button type="button" class="loan-term-btn active py-3 px-4 rounded-lg border-2 border-green-500 dark:border-green-400 bg-green-50 dark:bg-green-900/20 transition-colors font-semibold text-green-700 dark:text-green-300" data-years="5">5 năm</button>
                            <button type="button" class="loan-term-btn py-3 px-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-400 transition-colors font-semibold text-gray-700 dark:text-gray-300" data-years="7">7 năm</button>
                            <button type="button" class="loan-term-btn py-3 px-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-400 transition-colors font-semibold text-gray-700 dark:text-gray-300" data-years="10">10 năm</button>
                        </div>
                        <input type="hidden" id="loan-term" value="5">
                    </div>

                    <!-- Calculate Button -->
                    <button type="button" id="calculate-btn"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                        <i data-lucide="calculator" class="w-5 h-5"></i>
                        <span>Tính toán ngay</span>
                    </button>
                </form>
            </div>

            <!-- Results -->
            <div class="space-y-6">
                <!-- Summary Cards -->
                <div class="bg-gradient-to-br from-green-600 to-emerald-700 dark:from-green-700 dark:to-emerald-800 rounded-2xl shadow-xl p-8 text-white">
                    <h3 class="text-lg font-semibold mb-6 flex items-center">
                        <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
                        Kết quả tính toán
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-white/20">
                            <span class="text-white/80">Số tiền vay</span>
                            <span id="loan-amount" class="text-xl font-bold">400,000,000 VNĐ</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-white/20">
                            <span class="text-white/80">Lãi suất/năm</span>
                            <span id="display-interest-rate" class="text-xl font-bold">9%</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-white/20">
                            <span class="text-white/80">Thời gian</span>
                            <span id="display-loan-term" class="text-xl font-bold">5 năm</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mt-4">
                            <p class="text-white/80 text-sm mb-2">Trả hàng tháng</p>
                            <p id="monthly-payment" class="text-3xl font-bold">8,286,667 VNĐ</p>
                        </div>
                        <div class="flex justify-between items-center pt-3">
                            <span class="text-white/80">Tổng tiền phải trả</span>
                            <span id="total-payment" class="text-xl font-bold">497,200,000 VNĐ</span>
                        </div>
                    </div>
                </div>

                <!-- Breakdown Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i data-lucide="pie-chart" class="w-5 h-5 mr-2 text-green-600 dark:text-green-400"></i>
                        Cơ cấu thanh toán
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600 dark:text-gray-400">Gốc</span>
                                <span id="principal-amount" class="font-semibold text-gray-900 dark:text-white">400,000,000 VNĐ</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div id="principal-bar" class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full" style="width: 80%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600 dark:text-gray-400">Lãi</span>
                                <span id="interest-amount" class="font-semibold text-gray-900 dark:text-white">97,200,000 VNĐ</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div id="interest-bar" class="bg-gradient-to-r from-orange-500 to-red-600 h-3 rounded-full" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button id="show-schedule-btn"
                            class="bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-400 text-gray-700 dark:text-gray-300 font-semibold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        <span>Lịch trả góp</span>
                    </button>
                    <a href="{{ route('cars.index') }}"
                       class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
                        <i data-lucide="car" class="w-5 h-5"></i>
                        <span>Xem xe</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Payment Schedule Table -->
        <div id="payment-schedule" class="hidden max-w-7xl mx-auto mt-12">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6 bg-gradient-to-r from-green-600 to-emerald-600 text-white">
                    <h3 class="text-xl font-bold flex items-center">
                        <i data-lucide="list" class="w-6 h-6 mr-2"></i>
                        Lịch trả góp chi tiết
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Kỳ</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Trả hàng tháng</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Gốc</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Lãi</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">Dư nợ</th>
                            </tr>
                        </thead>
                        <tbody id="schedule-body" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Loan Packages -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Gói vay ưu đãi</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Các gói vay linh hoạt phù hợp với mọi nhu cầu
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Package 1 -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="zap" class="w-7 h-7 text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Vay nhanh</h3>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-4">7.5%</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-start text-gray-600 dark:text-gray-400">
                            <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Duyệt trong 24h</span>
                        </li>
                        <li class="flex items-start text-gray-600 dark:text-gray-400">
                            <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Thời gian vay: 3-5 năm</span>
                        </li>
                        <li class="flex items-start text-gray-600 dark:text-gray-400">
                            <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Trả trước 20%</span>
                        </li>
                    </ul>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors">
                        Chọn gói
                    </button>
                </div>

                <!-- Package 2 - Popular -->
                <div class="bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl shadow-xl p-8 text-white relative transform md:scale-105">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-yellow-400 text-gray-900 text-xs font-bold px-4 py-1 rounded-full">PHỔ BIẾN</span>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="star" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Vay tiêu chuẩn</h3>
                    <p class="text-3xl font-bold mb-4">9%</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Lãi suất cạnh tranh</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Thời gian vay: 3-7 năm</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Trả trước từ 15%</span>
                        </li>
                    </ul>
                    <button class="w-full bg-white text-green-600 hover:bg-gray-100 font-semibold py-3 rounded-lg transition-colors">
                        Chọn gói
                    </button>
                </div>

                <!-- Package 3 -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="award" class="w-7 h-7 text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Vay cao cấp</h3>
                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-4">11%</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-start text-gray-600 dark:text-gray-400">
                            <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Vay lên đến 90%</span>
                        </li>
                        <li class="flex items-start text-gray-600 dark:text-gray-400">
                            <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Thời gian vay: 5-10 năm</span>
                        </li>
                        <li class="flex items-start text-gray-600 dark:text-gray-400">
                            <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
                            <span>Trả trước chỉ 10%</span>
                        </li>
                    </ul>
                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition-colors">
                        Chọn gói
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Câu hỏi thường gặp</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Giải đáp các thắc mắc về vay mua xe
                </p>
            </div>

            <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-green-600 dark:text-green-400 flex-shrink-0 mt-1"></i>
                        Nên trả trước bao nhiêu khi mua xe trả góp?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Khuyến nghị trả trước từ 20-30% để giảm gánh nặng lãi suất. Trả trước càng cao, khoản vay càng thấp và tổng lãi phải trả cũng ít hơn.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-green-600 dark:text-green-400 flex-shrink-0 mt-1"></i>
                        Thời gian vay bao lâu là hợp lý?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Phổ biến là 3-7 năm. Thời gian càng ngắn, lãi suất tổng càng thấp nhưng khoản trả hàng tháng cao hơn. Chọn thời gian phù hợp với khả năng tài chính.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-green-600 dark:text-green-400 flex-shrink-0 mt-1"></i>
                        Có thể trả nợ trước hạn không?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Có, hầu hết các ngân hàng đều cho phép trả nợ trước hạn. Tuy nhiên có thể phát sinh phí trả trước từ 1-3% tùy ngân hàng và gói vay.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-green-600 dark:text-green-400 flex-shrink-0 mt-1"></i>
                        Giấy tờ cần thiết để vay mua xe?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        CMND/CCCD, hộ khẩu, sổ hộ khẩu, giấy tờ chứng minh thu nhập (hợp đồng lao động, sao kê lương), bảng kê thu nhập (nếu tự do kinh doanh).
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Format number
    function formatNumber(num) {
        return new Intl.NumberFormat('vi-VN').format(Math.round(num));
    }

    // Parse formatted number
    function parseFormattedNumber(str) {
        return parseFloat(str.replace(/[^\d]/g, '')) || 0;
    }

    // Update calculations
    function calculate() {
        const carPrice = parseFormattedNumber($('#car-price').val());
        const downPaymentPercent = parseFloat($('#down-payment-percent').val());
        const interestRate = parseFloat($('#interest-rate').val());
        const loanTermYears = parseInt($('#loan-term').val());

        // Calculations
        const downPaymentAmount = carPrice * (downPaymentPercent / 100);
        const loanAmount = carPrice - downPaymentAmount;
        const monthlyRate = (interestRate / 100) / 12;
        const numberOfPayments = loanTermYears * 12;

        // Monthly payment formula
        const monthlyPayment = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
                               (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
        
        const totalPayment = monthlyPayment * numberOfPayments;
        const totalInterest = totalPayment - loanAmount;

        // Update UI
        $('#down-payment-amount').text(formatNumber(downPaymentAmount) + ' VNĐ');
        $('#loan-amount').text(formatNumber(loanAmount) + ' VNĐ');
        $('#display-interest-rate').text(interestRate + '%');
        $('#display-loan-term').text(loanTermYears + ' năm');
        $('#monthly-payment').text(formatNumber(monthlyPayment) + ' VNĐ');
        $('#total-payment').text(formatNumber(totalPayment) + ' VNĐ');
        $('#principal-amount').text(formatNumber(loanAmount) + ' VNĐ');
        $('#interest-amount').text(formatNumber(totalInterest) + ' VNĐ');

        // Update bars
        const principalPercent = (loanAmount / totalPayment) * 100;
        const interestPercent = (totalInterest / totalPayment) * 100;
        $('#principal-bar').css('width', principalPercent + '%');
        $('#interest-bar').css('width', interestPercent + '%');

        return {
            loanAmount,
            monthlyRate,
            numberOfPayments,
            monthlyPayment
        };
    }

    // Generate payment schedule
    function generateSchedule() {
        const result = calculate();
        let balance = result.loanAmount;
        let scheduleHtml = '';

        for (let i = 1; i <= result.numberOfPayments; i++) {
            const interestPayment = balance * result.monthlyRate;
            const principalPayment = result.monthlyPayment - interestPayment;
            balance -= principalPayment;

            if (balance < 0) balance = 0;

            scheduleHtml += `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">${i}</td>
                    <td class="px-6 py-4 text-right text-gray-900 dark:text-white">${formatNumber(result.monthlyPayment)} VNĐ</td>
                    <td class="px-6 py-4 text-right text-gray-600 dark:text-gray-400">${formatNumber(principalPayment)} VNĐ</td>
                    <td class="px-6 py-4 text-right text-gray-600 dark:text-gray-400">${formatNumber(interestPayment)} VNĐ</td>
                    <td class="px-6 py-4 text-right text-gray-900 dark:text-white font-semibold">${formatNumber(balance)} VNĐ</td>
                </tr>
            `;
        }

        $('#schedule-body').html(scheduleHtml);
    }

    // Car price input/slider sync
    $('#car-price').on('input', function() {
        let value = parseFormattedNumber($(this).val());
        $('#car-price-slider').val(value);
        $(this).val(formatNumber(value));
        calculate();
    });

    $('#car-price-slider').on('input', function() {
        let value = $(this).val();
        $('#car-price').val(formatNumber(value));
        calculate();
    });

    // Down payment sync
    $('#down-payment-percent, #down-payment-slider').on('input', function() {
        let value = $(this).val();
        $('#down-payment-percent').val(value);
        $('#down-payment-slider').val(value);
        calculate();
    });

    // Interest rate sync
    $('#interest-rate, #interest-rate-slider').on('input', function() {
        let value = $(this).val();
        $('#interest-rate').val(value);
        $('#interest-rate-slider').val(value);
        calculate();
    });

    // Loan term buttons
    $('.loan-term-btn').on('click', function() {
        $('.loan-term-btn').removeClass('active border-green-500 dark:border-green-400 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300')
                           .addClass('border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300');
        $(this).addClass('active border-green-500 dark:border-green-400 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300')
               .removeClass('border-gray-300 dark:border-gray-600');
        
        const years = $(this).data('years');
        $('#loan-term').val(years);
        calculate();
    });

    // Calculate button
    $('#calculate-btn').on('click', function() {
        calculate();
        $('html, body').animate({
            scrollTop: $('#payment-schedule').offset().top - 100
        }, 500);
    });

    // Show schedule
    $('#show-schedule-btn').on('click', function() {
        generateSchedule();
        $('#payment-schedule').removeClass('hidden').hide().slideDown(400);
        $('html, body').animate({
            scrollTop: $('#payment-schedule').offset().top - 100
        }, 500);
    });

    // Initial calculation
    calculate();
});
</script>
@endsection
