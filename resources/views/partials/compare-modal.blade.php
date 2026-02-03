<!-- Compare Modal -->
<div id="compareModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-main rounded-2xl shadow-2xl max-w-7xl w-full max-h-[90vh] overflow-hidden flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <div>
                <h2 class="text-2xl font-bold text-main flex items-center gap-3">
                    <i data-lucide="git-compare" class="w-7 h-7 text-purple-600"></i>
                    So sánh xe
                </h2>
                <p class="text-sm text-sub mt-1">Chọn từ 2 đến 3 xe để so sánh chi tiết</p>
            </div>
            <button onclick="closeCompareModal()" class="text-sub hover:text-main transition-colors p-2">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <div id="compareContent" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Cars will be dynamically inserted here -->
            </div>

            <!-- Empty State -->
            <div id="compareEmptyState" class="text-center py-16">
                <i data-lucide="git-compare" class="w-20 h-20 text-gray-300 dark:text-gray-600 mx-auto mb-4"></i>
                <h3 class="text-xl font-semibold text-main mb-2">Chưa có xe để so sánh</h3>
                <p class="text-sub mb-6">Thêm ít nhất 2 xe vào danh sách để bắt đầu so sánh</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div class="text-sm text-sub">
                    <span id="compareSelectedCount">0</span> xe được chọn (Tối đa 3 xe)
                </div>
                <div class="flex gap-3">
                    <button 
                        onclick="clearAllCompare()" 
                        class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-main rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 font-medium">
                        Xóa tất cả
                    </button>
                    <button 
                        id="compareNowBtn"
                        onclick="performCompare()" 
                        class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-300 font-medium shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        So sánh ngay
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Compare functionality
let compareList = JSON.parse(localStorage.getItem('compareList') || '[]');

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCompareUI();
    updateCompareButton();
});

// Add car to compare list
function addToCompare(carId) {
    // Check if already exists
    if (compareList.includes(carId)) {
        showNotification('Xe này đã có trong danh sách so sánh', 'warning');
        return;
    }

    // Check max limit
    if (compareList.length >= 3) {
        showNotification('Chỉ có thể so sánh tối đa 3 xe', 'error');
        return;
    }

    // Add to list
    compareList.push(carId);
    localStorage.setItem('compareList', JSON.stringify(compareList));
    
    updateCompareUI();
    updateCompareButton();
    showNotification('Đã thêm xe vào danh sách so sánh', 'success');
}

// Remove car from compare list
function removeFromCompare(carId) {
    compareList = compareList.filter(id => id !== carId);
    localStorage.setItem('compareList', JSON.stringify(compareList));
    
    updateCompareUI();
    updateCompareButton();
    showNotification('Đã xóa xe khỏi danh sách', 'info');
}

// Clear all compare list
function clearAllCompare() {
    if (confirm('Bạn có chắc muốn xóa tất cả xe khỏi danh sách so sánh?')) {
        compareList = [];
        localStorage.setItem('compareList', JSON.stringify(compareList));
        updateCompareUI();
        updateCompareButton();
        showNotification('Đã xóa tất cả xe', 'info');
    }
}

// Open compare modal
function openCompareModal() {
    let data = localStorage.getItem('compareList');
    compareList = data ? JSON.parse(data) : [];
    if (compareList.length <= 1) {
        showNotification('Chọn ít nhất 2 xe để so sánh', 'warning');
        return;
    }
    // chuyển thành dạng 1,2,3
    compareList = compareList.join(',');
    window.location.href = `{{ route('cars.compare') }}?ids=${compareList}`;
}

// Close compare modal
function closeCompareModal() {
    document.getElementById('compareModal').classList.add('hidden');
    document.getElementById('compareModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Update compare UI
function updateCompareUI() {
    const content = document.getElementById('compareContent');
    const emptyState = document.getElementById('compareEmptyState');
    const countElement = document.getElementById('compareSelectedCount');
    const compareBtn = document.getElementById('compareNowBtn');
    
    countElement.textContent = compareList.length;
    
    // Show/hide empty state
    if (compareList.length === 0) {
        emptyState.classList.remove('hidden');
        content.classList.add('hidden');
        compareBtn.disabled = true;
    } else {
        emptyState.classList.add('hidden');
        content.classList.remove('hidden');
        compareBtn.disabled = compareList.length < 2;
    }
    
    // Render cars
    content.innerHTML = compareList.map(car => `
        <div class="bg-main-gray dark:bg-gray-800 rounded-xl p-5 border-2 border-purple-200 dark:border-purple-900 relative">
            <button 
                onclick="removeFromCompare(${car.id})"
                class="absolute top-3 right-3 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors"
                title="Xóa">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
            
            <div class="mb-4">
                <h3 class="font-bold text-lg text-main mb-1 pr-8 line-clamp-2">${car.title}</h3>
                ${car.year ? `<span class="text-sub text-sm">(${car.year})</span>` : ''}
            </div>
            
            ${car.price ? `
                <div class="text-2xl font-bold text-purple-600 mb-4">
                    ${(car.price / 1000000).toLocaleString('vi-VN')} <small class="text-sm">triệu</small>
                </div>
            ` : ''}
            
            <div class="space-y-3 text-sm">
                ${car.mileage ? `
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="gauge" class="w-4 h-4 text-green-500"></i>
                        <span>${car.mileage}</span>
                    </div>
                ` : ''}
                
                ${car.fuel ? `
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="fuel" class="w-4 h-4 text-orange-500"></i>
                        <span>${car.fuel}</span>
                    </div>
                ` : ''}
                
                ${car.bodytype ? `
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="cog" class="w-4 h-4 text-purple-500"></i>
                        <span>${car.bodytype}</span>
                    </div>
                ` : ''}
            </div>
        </div>
    `).join('');
    
    // Re-initialize lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

// Update floating compare button
function updateCompareButton() {
    const btn = document.getElementById('compareFloatingBtn');
    const count = document.getElementById('compareCount');
    
    count.textContent = compareList.length;
    
    if (compareList.length > 0) {
        btn.classList.remove('hidden');
    } else {
        btn.classList.add('hidden');
    }
}

// Perform comparison (redirect to comparison page)
function performCompare() {
    if (compareList.length < 2) {
        showNotification('Vui lòng chọn ít nhất 2 xe để so sánh', 'warning');
        return;
    }
    
    // Redirect to comparison page with IDs
    const ids = compareList.join(',');
    window.location.href = `{{ route('cars.compare') }}?ids=${ids}`;
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-20 right-6 z-[60] px-6 py-4 rounded-md shadow-2xl transform transition-all duration-300 translate-x-0 ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' :
        'bg-blue-500'
    } text-white font-medium flex items-center gap-3`;
    
    const icon = type === 'success' ? 'fa-solid fa-circle-check' :
                 type === 'error' ? 'fa-solid fa-circle-xmark' :
                 type === 'warning' ? 'fa-solid fa-triangle-exclamation' :
                 'fa-solid fa-info-circle';
    
    notification.innerHTML = `
        <i class="w-5 h-5 ${icon}"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    // Re-initialize lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('compareModal');
    if (e.target === modal) {
        closeCompareModal();
    }
});
</script>
