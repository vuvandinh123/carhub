<div class="bg-gray-100 dark:bg-gray-900">
    <div class="grid container max-w-7xl mx-auto grid-cols-1 md:grid-cols-2 ">
        <!-- Left Side - Form -->
        <div class="flex items-center justify-center ">
            <div class="  p-8 w-full  rounded-3xl bg-white dark:bg-gray-100">
                <h2 class="text-2xl text-gray-900 font-bold  mb-2">Đăng ký tư vấn mua xe</h2>
                <p class="text-gray-500 text-sm mb-6">
                    Điền thông tin của bạn để nhận tư vấn chi tiết và đăng ký lái thử xe.
                </p>

                <form action="{{ route('consultation.store') }}" method="POST" class="space-y-4 grid grid-cols-2 gap-3 ">
                    @csrf
                    <div>
                        <label class="block text-brand-black text-sm mb-1">Họ và tên</label>
                        <input name="name" type="text" placeholder="Nguyễn Văn A"
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-brand-black text-sm mb-1">Số điện thoại</label>
                        <input name="phone" type="tel" placeholder="090xxxxxxx"
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div class="w-full col-span-2">

                        <label for="budget"
                            class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="wallet" class="w-3.5 h-3.5 text-yellow-600"></i>
                            Ngân sách dự kiến
                        </label>
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

                    {{-- <div>
                        <label class="block text-brand-black text-sm mb-1">Dòng xe quan tâm</label>
                        <select
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option>Chọn xe</option>
                            <option>Audi e-tron GT</option>
                            <option>Mercedes C-Class</option>
                            <option>BMW 3 Series</option>
                            <option>Toyota Camry</option>
                        </select>
                    </div> --}}

                    <button type="submit"
                        class="w-full bg-linear-to-r from-primary-900 to-primary-800 hover:bg-linear-to-r hover:from-primary-800 hover:to-primary-900 cursor-pointer text-white py-2 rounded-lg font-semibold transition">
                        Đăng ký ngay
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Side - Image -->
        <div class="hidden md:block p-5">
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Car Loan" class="w-full h-full object-cover rounded-2xl">
        </div>
    </div>
</div>
