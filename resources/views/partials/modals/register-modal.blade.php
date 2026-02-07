<div id="register-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-[#1E3A8A]/30  backdrop-blur-sm transition-opacity duration-300 z-40"></div>
    <div class="relative p-4 w-full max-w-xl max-h-full z-50 animate-[slide-in_0.4s_ease]">
        <!-- Modal content -->
        <div class="relative bg-primary-900 rounded-[2rem] shadow-2xl overflow-hidden transition-all duration-500 hover:shadow-[0_8px_40px_0_rgba(30,58,138,0.25)]">
            <!-- Decorative Header Background -->
            <div class="absolute top-0 left-0 right-0 h-28 bg-gradient-to-r from-primary-900 via-primary-800 to-primary-700 opacity-40"></div>
            
            <!-- Modal header -->
            <div class="relative flex items-center justify-between p-6 border-b-2 border-blue-800">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 via-[#1E3A8A] to-blue-900 rounded-xl flex items-center justify-center shadow-xl border-2 border-white/30">
                        <i data-lucide="car" class="w-7 h-7 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl uppercase text-white drop-shadow">Đăng Ký Tư Vấn</h3>
                        <p class="text-xs text-blue-100">Liên hệ trong 24h</p>
                    </div>
                </div>
                <button type="button" class="text-blue-100 bg-transparent hover:bg-blue-900/30 hover:text-white rounded-lg text-lg w-9 h-9 inline-flex justify-center items-center transition-all" data-modal-hide="register-modal">
                    <i data-lucide="x" class="w-5 h-5"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-7 bg-white rounded-b-[2rem] backdrop-blur-md transition-all duration-500">
                <form action="{{ route('consultation.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Họ và tên -->
                    <div>
                        <label for="name" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="user" class="w-3.5 h-3.5 text-blue-600"></i>
                            Họ và tên <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                            class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                   focus:ring-1 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                   dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                   transition-all duration-300 hover:border-blue-300"
                            placeholder="Nguyễn Văn A" required>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Số điện thoại -->
                        <div>
                            <label for="phone" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-green-600"></i>
                                Số điện thoại <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" id="phone"
                                class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                       focus:ring-1 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                       dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                       transition-all duration-300 hover:border-blue-300"
                                placeholder="0912345678" required>
                        </div>

                        <!-- Loại xe -->
                        <div>
                            <label for="car_type" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                                <i data-lucide="car-front" class="w-3.5 h-3.5 text-orange-600"></i>
                                Loại xe
                            </label>
                            <div class="relative">
                                <select id="car_type" name="car_type"
                                    class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                           focus:ring-1 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                           dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                           transition-all duration-300 hover:border-blue-300 appearance-none cursor-pointer">
                                    <option value="">Chọn loại</option>
                                    <option value="suv">SUV</option>
                                    <option value="sedan">Sedan</option>
                                    <option value="pickup">Pickup</option>
                                    <option value="hatchback">Hatchback</option>
                                    <option value="mpv">MPV</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ngân sách -->
                    <div>
                        <label for="budget" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="wallet" class="w-3.5 h-3.5 text-yellow-600"></i>
                            Ngân sách dự kiến
                        </label>
                        <div class="relative">
                            <select id="budget" name="budget"
                                class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                       dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                       transition-all duration-300 hover:border-blue-300 appearance-none cursor-pointer">
                                <option value="">Chọn ngân sách</option>
                                <option value="under-500">Dưới 500 triệu</option>
                                <option value="500-1200">500 triệu - 1.2 tỷ</option>
                                <option value="1200-2000">1.2 - 2 tỷ</option>
                                <option value="over-2000">Trên 2 tỷ</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Ghi chú -->
                    <div>
                        <label for="note" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="message-square" class="w-3.5 h-3.5 text-pink-600"></i>
                            Ghi chú
                        </label>
                        <textarea id="note" name="note" rows="2"
                            class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                   dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                   transition-all duration-300 hover:border-blue-300 resize-none"
                            placeholder="Nhu cầu sử dụng xe..."></textarea>
                    </div>

                    <!-- Benefits Info (compact) -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center gap-4 text-xs text-sub">
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-600"></i>
                                Tư vấn miễn phí
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-600"></i>
                                Hỗ trợ vay 80%
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-600"></i>
                                Giảm giá đặc biệt
                            </span>
                        </div>
                    </div>

                    <!-- Nút gửi -->
                    <button type="submit"
                        class="w-full text-white bg-gradient-to-r from-primary-800 via-primary-700 to-primary-900 hover:from-primary-900 hover:to-primary-700 
                        cursor-pointer 
                               focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-xl 
                               text-base px-5 py-3 text-center 
                               transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-[1.03]
                               flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-5 h-5"></i>
                        Gửi Đăng Ký Ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

