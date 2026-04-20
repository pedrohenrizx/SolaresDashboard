<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex hidden" id="page-body">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <?php include 'includes/topbar.php'; ?>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                Custom Reports
            </h2>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-3xl mx-auto">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Type</label>
                    <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md dark:bg-gray-700">
                        <option>Monthly Executive Summary</option>
                        <option>Detailed Customer Churn Report</option>
                        <option>Marketing Channel ROI</option>
                    </select>
                </div>

                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                        <input type="date" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm dark:bg-gray-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                        <input type="date" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm dark:bg-gray-700">
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button id="export-pdf-btn" class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors flex items-center">
                        <i class="fas fa-file-pdf mr-2"></i> Export as PDF
                    </button>
                    <button id="export-excel-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors flex items-center">
                        <i class="fas fa-file-excel mr-2"></i> Export as Excel
                    </button>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById('page-body').classList.remove('hidden');

            async function fetchReportData() {
                showToast("Generating report data...", "info");
                try {
                    const Customer = Parse.Object.extend("Customer");
                    const query = new Parse.Query(Customer);
                    query.descending("createdAt");
                    const results = await query.find();

                    return results.map(c => ({
                        Name: c.get('name'),
                        Location: c.get('location'),
                        Category: c.get('category'),
                        Status: c.get('status'),
                        TotalSpent: c.get('totalSpent')
                    }));
                } catch (error) {
                    showToast("Error fetching data: " + error.message, "error");
                    return [];
                }
            }

            document.getElementById('export-excel-btn').addEventListener('click', async () => {
                const data = await fetchReportData();
                if (data.length === 0) {
                    showToast("No data to export", "error");
                    return;
                }

                try {
                    const worksheet = XLSX.utils.json_to_sheet(data);
                    const workbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(workbook, worksheet, "Customers");
                    XLSX.writeFile(workbook, "Customer_Report.xlsx");
                    showToast("Excel Exported successfully!", "success");
                } catch(e) {
                    showToast("Error exporting Excel: " + e.message, "error");
                }
            });

            document.getElementById('export-pdf-btn').addEventListener('click', async () => {
                const data = await fetchReportData();
                if (data.length === 0) {
                    showToast("No data to export", "error");
                    return;
                }

                try {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    doc.text("Customer Report", 14, 15);
                    doc.setFontSize(10);
                    doc.text("Generated on: " + new Date().toLocaleDateString(), 14, 22);

                    const tableColumn = ["Name", "Location", "Category", "Status", "Total Spent"];
                    const tableRows = [];

                    data.forEach(customer => {
                        const rowData = [
                            customer.Name,
                            customer.Location,
                            customer.Category,
                            customer.Status,
                            "$" + parseFloat(customer.TotalSpent).toFixed(2)
                        ];
                        tableRows.push(rowData);
                    });

                    doc.autoTable({
                        head: [tableColumn],
                        body: tableRows,
                        startY: 30,
                    });

                    doc.save("Customer_Report.pdf");
                    showToast("PDF Exported successfully!", "success");
                } catch(e) {
                    showToast("Error exporting PDF: " + e.message, "error");
                }
            });
        });
    </script>
</body>
</html>
