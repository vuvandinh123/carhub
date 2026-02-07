@extends('layouts.app')

@section('title', 'Giới thiệu | THACO Thủ Đức')
@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Giới thiệu | THACO Thủ Đức',
        'meta_description' => 'Tìm hiểu về THACO Thủ Đức, sứ mệnh và tầm nhìn của chúng tôi trong ngành công nghiệp ô tô tại Việt Nam.',
        'meta_keywords' => 'THACO Thủ Đức, giới thiệu, sứ mệnh, tầm nhìn, ô tô',
        'meta_image' => asset('storage/default-image.jpg'),
    ])
@endsection
@section('content')
<div class="bg-main">
    <!-- Hero Section -->
    <section class="relative bg-primary-800 text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute transform rotate-45 -right-20 -top-20 w-96 h-96 bg-white rounded-full"></div>
            <div class="absolute transform rotate-45 -left-20 -bottom-20 w-96 h-96 bg-white rounded-full"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-5xl font-bold mb-6 animate-fade-in">Về Chúng Tôi</h1>
                <p class="text-xl leading-relaxed opacity-90">
                    THACO Thủ Đức - Nền tảng mua bán và tư vấn xe hơi hàng đầu Việt Nam, 
                    mang đến cho bạn trải nghiệm tìm kiếm xe mơ ước một cách dễ dàng và tin cậy nhất.
                </p>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-16 bg-main-gray">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <!-- Mission -->
                <div class="bg-main rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                            <i data-lucide="target" class="w-8 h-8 text-white"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-main">Sứ Mệnh</h2>
                    </div>
                    <p class="text-sub text-lg leading-relaxed">
                        Cung cấp nền tảng công nghệ hiện đại giúp người mua và người bán xe kết nối một cách 
                        minh bạch, nhanh chóng và an toàn. Chúng tôi cam kết mang đến trải nghiệm tuyệt vời 
                        nhất cho khách hàng trong hành trình tìm kiếm chiếc xe ưng ý.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-main rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-primary-800 rounded-full flex items-center justify-center">
                            <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-main">Tầm Nhìn</h2>
                    </div>
                    <p class="text-sub text-lg leading-relaxed">
                        Trở thành nền tảng số 1 về mua bán và tư vấn xe hơi tại Việt Nam, 
                        được tin tưởng bởi hàng triệu người dùng. Chúng tôi hướng đến việc 
                        số hóa toàn bộ quy trình mua bán xe, mang lại sự thuận tiện tối đa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="py-16 bg-main">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-main mb-4">Giá Trị Cốt Lõi</h2>
                <p class="text-sub text-lg max-w-2xl mx-auto">
                    Những giá trị định hướng mọi hoạt động của chúng tôi
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <!-- Value 1 -->
                <div class="group bg-main-gray rounded-xl p-6 text-center hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-primary-800">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="shield-check" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-main mb-3">Uy Tín</h3>
                    <p class="text-sub">
                        Minh bạch trong mọi giao dịch, đảm bảo quyền lợi khách hàng
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="group bg-main-gray rounded-xl p-6 text-center hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-green-500">
                    <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="zap" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-main mb-3">Nhanh Chóng</h3>
                    <p class="text-sub">
                        Xử lý thông tin và phản hồi khách hàng trong thời gian ngắn nhất
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="group bg-main-gray rounded-xl p-6 text-center hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-purple-500">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-main mb-3">Tận Tâm</h3>
                    <p class="text-sub">
                        Đặt khách hàng làm trung tâm, hỗ trợ 24/7 mọi lúc mọi nơi
                    </p>
                </div>

                <!-- Value 4 -->
                <div class="group bg-main-gray rounded-xl p-6 text-center hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-orange-500">
                    <div class="w-20 h-20 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="sparkles" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-main mb-3">Đổi Mới</h3>
                    <p class="text-sub">
                        Không ngừng cải tiến công nghệ để mang đến trải nghiệm tốt nhất
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gradient-to-r from-primary-900 to-primary-800 text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2" data-count="10000">50+</div>
                    <div class="text-xl opacity-90">Xe được niêm yết</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2" data-count="5000">100+</div>
                    <div class="text-xl opacity-90">Giao dịch thành công</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2" data-count="50000">1000+</div>
                    <div class="text-xl opacity-90">Khách hàng tin dùng</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-bold mb-2" data-count="100">10+</div>
                    <div class="text-xl opacity-90">Đối tác uy tín</div>
                </div>
            </div>
        </div>
    </section>


    <!-- Why Choose Us Section -->
    <section class="py-16 bg-main-gray">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-main mb-4">Tại Sao Chọn Chúng Tôi?</h2>
                <p class="text-sub text-lg max-w-2xl mx-auto">
                    Những lợi ích vượt trội khi sử dụng dịch vụ của Xedep.vn
                </p>
            </div>

            <div class="max-w-6xl mx-auto space-y-6">
                <!-- Feature 1 -->
                <div class="bg-main rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex items-start gap-6 group border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <i data-lucide="search" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-main mb-2">Tìm Kiếm Thông Minh</h3>
                        <p class="text-sub">
                            Hệ thống lọc và tìm kiếm tiên tiến giúp bạn nhanh chóng tìm được chiếc xe phù hợp nhất 
                            với nhu cầu và ngân sách của mình.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-main rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex items-start gap-6 group border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <i data-lucide="shield-check" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-main mb-2">Đảm Bảo Chất Lượng</h3>
                        <p class="text-sub">
                            Tất cả các xe được kiểm định kỹ lưỡng trước khi đăng tải. Chúng tôi cam kết 
                            100% thông tin chính xác và minh bạch.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-main rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex items-start gap-6 group border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <i data-lucide="headphones" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-main mb-2">Hỗ Trợ 24/7</h3>
                        <p class="text-sub">
                            Đội ngũ tư vấn chuyên nghiệp sẵn sàng hỗ trợ bạn mọi lúc mọi nơi. 
                            Hotline luôn sẵn sàng giải đáp mọi thắc mắc.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="bg-main rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 flex items-start gap-6 group border border-gray-200 dark:border-gray-700">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <i data-lucide="dollar-sign" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-main mb-2">Giá Cả Cạnh Tranh</h3>
                        <p class="text-sub">
                            So sánh giá từ nhiều nguồn khác nhau, đảm bảo bạn luôn có được mức giá tốt nhất 
                            trên thị trường.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-900 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Sẵn Sàng Tìm Xe Của Bạn?</h2>
            <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                Hãy để chúng tôi giúp bạn tìm được chiếc xe hoàn hảo. 
                Hàng ngàn lựa chọn đang chờ bạn khám phá!
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="{{ route('cars.index') }}" 
                    class="px-8 py-4 bg-white text-primary-800 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl inline-flex items-center gap-2">
                    <i data-lucide="car" class="w-5 h-5"></i>
                    Xem Tất Cả Xe
                </a>
                <button data-modal-target="register-modal" data-modal-toggle="register-modal"
                    class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-primary-800 transition-all duration-300 inline-flex items-center gap-2">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                    Liên Hệ Ngay
                </button>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    // Counter animation for statistics
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('[data-count]');
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current).toLocaleString('vi-VN') + '+';
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString('vi-VN') + '+';
                }
            };
            
            updateCounter();
        };
        
        // Intersection Observer for triggering animation when in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => observer.observe(counter));
    });
</script>
@endpush
@endsection
