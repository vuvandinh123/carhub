@extends('layouts.app')

@section('title', 'Liên hệ - CarHub')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-purple-800 dark:from-gray-900 dark:via-blue-900 dark:to-purple-900 py-20">
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 backdrop-blur-sm rounded-full mb-6">
                <i data-lucide="headset" class="w-8 h-8 text-white"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Liên hệ với chúng tôi</h1>
            <p class="text-lg text-white/90">
                Hãy để lại thông tin, chúng tôi sẽ liên hệ tư vấn cho bạn trong thời gian sớm nhất
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

<!-- Contact Info Cards -->
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 -mt-32 relative z-20 mb-16">
            <!-- Phone -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl mb-4">
                    <i data-lucide="phone" class="w-7 h-7 text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Điện thoại</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-3">Liên hệ trực tiếp</p>
                <a href="tel:0123456789" class="text-blue-600 dark:text-blue-400 font-semibold text-lg hover:text-blue-700">
                    0123 456 789
                </a>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">T2 - T7: 8:00 - 18:00</p>
            </div>

            <!-- Email -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl mb-4">
                    <i data-lucide="mail" class="w-7 h-7 text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Email</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-3">Gửi email cho chúng tôi</p>
                <a href="mailto:contact@carhub.vn" class="text-purple-600 dark:text-purple-400 font-semibold text-lg hover:text-purple-700 break-all">
                    contact@carhub.vn
                </a>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Phản hồi trong 24h</p>
            </div>

            <!-- Address -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl mb-4">
                    <i data-lucide="map-pin" class="w-7 h-7 text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Địa chỉ</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-3">Ghé thăm showroom</p>
                <p class="text-gray-900 dark:text-gray-300 font-medium">
                    123 Đường ABC, Quận 1, TP.HCM
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Mở cửa cả CN</p>
            </div>
        </div>

        <!-- Main Contact Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Gửi tin nhắn</h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Điền thông tin bên dưới và chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất
                    </p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Họ và tên <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name" required
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400"
                                   placeholder="Nhập họ tên của bạn">
                        </div>
                    </div>

                    <!-- Email & Phone -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="email" id="email" name="email" required
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400"
                                       placeholder="email@example.com">
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Số điện thoại <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="phone" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="tel" id="phone" name="phone" required
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400"
                                       placeholder="0123456789">
                            </div>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Chủ đề
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="bookmark" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <select id="subject" name="subject"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                <option value="">Chọn chủ đề</option>
                                <option value="buy">Tư vấn mua xe</option>
                                <option value="sell">Tư vấn bán xe</option>
                                <option value="service">Dịch vụ hậu mãi</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nội dung <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  class="block w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 resize-none"
                                  placeholder="Nhập nội dung tin nhắn của bạn..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                        <i data-lucide="send" class="w-5 h-5"></i>
                        <span>Gửi tin nhắn</span>
                    </button>
                </form>
            </div>

            <!-- Additional Information -->
            <div class="space-y-8">
                <!-- Business Hours -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-8 border border-blue-100 dark:border-gray-600">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                                <i data-lucide="clock" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Giờ làm việc</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">Thứ 2 - Thứ 6</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">8:00 - 18:00</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">Thứ 7</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">8:00 - 17:00</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 dark:text-gray-300">Chủ nhật</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">9:00 - 16:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Why Contact Us -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Tại sao nên liên hệ với chúng tôi?</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Tư vấn miễn phí từ đội ngũ chuyên nghiệp</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Phản hồi nhanh chóng trong 24h</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Hỗ trợ trước và sau khi mua xe</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Báo giá cạnh tranh và minh bạch</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">Hỗ trợ vay tài chính lãi suất ưu đãi</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-8 text-white">
                    <h3 class="text-xl font-bold mb-4">Kết nối với chúng tôi</h3>
                    <p class="text-gray-300 mb-6">Theo dõi để cập nhật thông tin mới nhất</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="youtube" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors duration-300">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Vị trí showroom</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Ghé thăm showroom để trải nghiệm trực tiếp các dòng xe
                </p>
            </div>
            
            <!-- Map Embed -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">
                <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700" style="height: 450px;">
                    <!-- Replace with actual Google Maps embed -->
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6304931675717!2d106.69831731533427!3d10.762622892328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4b3330bcc9%3A0xb15a5e29bcf364b5!2sBitexco%20Financial%20Tower!5e0!3m2!1sen!2s!4v1234567890" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full">
                    </iframe>
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
                    Giải đáp những thắc mắc phổ biến của khách hàng
                </p>
            </div>

            <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-1"></i>
                        Tôi cần chuẩn bị những giấy tờ gì khi mua xe?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Bạn cần chuẩn bị CMND/CCCD, hộ khẩu, bằng lái xe (nếu có), và giấy tờ chứng minh thu nhập nếu vay mua.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-1"></i>
                        Thời gian giao xe mất bao lâu?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Tùy vào từng dòng xe, thời gian giao xe từ 3-7 ngày làm việc sau khi hoàn tất thủ tục và thanh toán.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-1"></i>
                        Có hỗ trợ vay mua xe không?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Có, chúng tôi hỗ trợ vay lên đến 80% giá trị xe với lãi suất ưu đãi và thủ tục nhanh chóng.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 flex items-start">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-1"></i>
                        Có được lái thử xe trước khi mua không?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 ml-7">
                        Có, bạn có thể đăng ký lái thử xe miễn phí tại showroom. Vui lòng mang theo bằng lái xe hợp lệ.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-900 dark:to-purple-900">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Bạn đã sẵn sàng tìm chiếc xe lý tưởng?
            </h2>
            <p class="text-lg text-white/90 mb-8">
                Hãy liên hệ với chúng tôi ngay hôm nay để nhận tư vấn miễn phí và báo giá tốt nhất
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:0123456789" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                    <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                    Gọi ngay: 0123 456 789
                </a>
                <a href="{{ route('cars.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-lg hover:bg-white/20 transition-colors duration-300 border-2 border-white">
                    <i data-lucide="car" class="w-5 h-5 mr-2"></i>
                    Xem xe hiện có
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
