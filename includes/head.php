<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CustomerFlow Analytics</title>
<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📊</text></svg>">
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    primary: '#4f46e5',
                }
            }
        }
    }
</script>
<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Parse SDK -->
<script type="text/javascript" src="https://unpkg.com/parse/dist/parse.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- SheetJS (Excel Export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- jsPDF (PDF Export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<!-- Custom JS -->
<script src="/js/parse-init.js"></script>
<script src="/js/main.js"></script>

<!-- Global Toast Container -->
<style>
    /* Smooth transition for dark mode */
    html { transition: background-color 0.3s ease, color 0.3s ease; }

    /* Toast Animation */
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    .toast-enter { animation: slideInRight 0.3s ease forwards; }
    .toast-exit { animation: fadeOut 0.3s ease forwards; }
</style>
<div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Floating Action Button -->
<button id="fab-button" onclick="showToast('Action Menu Opened!', 'info')" class="fixed bottom-6 right-6 bg-primary text-white rounded-full p-4 shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary z-40 transition-transform transform hover:scale-110" aria-label="Quick Actions">
    <i class="fas fa-plus text-xl"></i>
</button>
