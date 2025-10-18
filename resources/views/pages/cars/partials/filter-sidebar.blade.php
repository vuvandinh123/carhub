<div class="w-80 space-y-6">
    <!-- New/Used Toggle -->
    <div class="bg-main rounded-lg p-4">
        <div class="flex bg-gray-100 dark:bg-gray-800 rounded-lg p-1">
            <button
                class="flex-1 py-2 text-center text-gray-600 hover:bg-white hover:shadow-sm rounded-md transition">
            Xe mới
            </button>
            <button class="flex-1 py-2 text-center bg-white dark:bg-gray-700 shadow-sm rounded-md font-medium">
                Xe cũ
            </button>
        </div>
    </div>
    <!-- Hãng xe -->
    <div>
        <label class="block text-sm font-medium  mb-1">Hãng xe</label>
        <select class="w-full border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Chọn hãng --</option>
            <option value="toyota">Toyota</option>
            <option value="bmw">BMW</option>
            <option value="mercedes">Mercedes</option>
            <option value="tesla">Tesla</option>
        </select>
    </div>

    <!-- Năm sản xuất -->
    <div>
        <label class="block text-sm font-medium  mb-1">Năm sản xuất</label>
        <div class="flex gap-2">
            <input type="number" placeholder="Từ"
                class="w-1/2 border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <input type="number" placeholder="Đến"
                class="w-1/2 border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
    </div>

    <!-- Giá bán -->
    <div>
        <label class="block text-sm font-medium  mb-1">Giá bán (triệu VNĐ)</label>
        <div class="flex gap-2">
            <input type="number" placeholder="Min"
                class="w-1/2 border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <input type="number" placeholder="Max"
                class="w-1/2 border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
    </div>

    <!-- Loại nhiên liệu -->
    <div>
        <label class="block text-sm font-medium  mb-1">Nhiên liệu</label>
        <div class="space-y-1 text-sm text-sub">
            <label class="flex items-center gap-2">
                <input type="checkbox" class="text-blue-600 border-gray-300 rounded"> Xăng
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" class="text-blue-600 border-gray-300 rounded"> Dầu
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" class="text-blue-600 border-gray-300 rounded"> Hybrid
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" class="text-blue-600 border-gray-300 rounded"> Điện
            </label>
        </div>
    </div>

    <!-- Hộp số -->
    <div>
        <label class="block text-sm font-medium  mb-1">Hộp số</label>
        <div class="space-y-1 text-sm text-sub">
            <label class="flex items-center gap-2">
                <input type="radio" name="gearbox" class="text-blue-600 border-gray-300"> Tự động
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="gearbox" class="text-blue-600 border-gray-300"> Số sàn
            </label>
        </div>
    </div>

    <!-- Khu vực -->
    <div>
        <label class="block text-sm font-medium  mb-1">Khu vực</label>
        <select class="w-full border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Chọn khu vực --</option>
            <option value="hanoi">Hà Nội</option>
            <option value="hcm">Hồ Chí Minh</option>
            <option value="danang">Đà Nẵng</option>
            <option value="haiphong">Hải Phòng</option>
        </select>
    </div>

    <!-- Nút hành động -->
    <div class="flex gap-2">
        <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Áp dụng
        </button>
        <button class="flex-1 bg-gray-100  py-2 rounded-lg hover:bg-gray-200 transition">
            Reset
        </button>
    </div>
</div>
