window.openAddCustomerModal = function() {
    document.getElementById('customer-modal').classList.remove('hidden');
    document.getElementById('modal-title').innerText = 'Add New Customer';
    document.getElementById('customer-id').value = '';
    document.getElementById('customer-form').reset();
};

window.closeCustomerModal = function() {
    document.getElementById('customer-modal').classList.add('hidden');
};

window.editCustomer = async function(id) {
    document.getElementById('customer-modal').classList.remove('hidden');
    document.getElementById('modal-title').innerText = 'Edit Customer';
    document.getElementById('customer-id').value = id;

    // Show spinner in form
    document.getElementById('save-btn-text').innerText = 'Loading...';
    document.getElementById('save-btn-spinner').classList.remove('hidden');
    document.getElementById('save-customer-btn').disabled = true;

    try {
        const Customer = Parse.Object.extend("Customer");
        const query = new Parse.Query(Customer);
        const customer = await query.get(id);

        document.getElementById('customer-name').value = customer.get("name") || '';
        document.getElementById('customer-location').value = customer.get("location") || '';
        document.getElementById('customer-category').value = customer.get("category") || 'Retail';
        document.getElementById('customer-status').value = customer.get("status") || 'New';
        document.getElementById('customer-spent').value = customer.get("totalSpent") || 0;

    } catch (error) {
        console.error("Error fetching customer:", error);
        showToast("Error loading customer data", "error");
        window.closeCustomerModal();
    } finally {
        document.getElementById('save-btn-text').innerText = 'Save';
        document.getElementById('save-btn-spinner').classList.add('hidden');
        document.getElementById('save-customer-btn').disabled = false;
    }
};

window.deleteCustomer = async function(id) {
    if(!confirm("Are you sure you want to delete this customer?")) return;

    try {
        const Customer = Parse.Object.extend("Customer");
        const query = new Parse.Query(Customer);
        const customer = await query.get(id);
        await customer.destroy();
        showToast("Customer deleted successfully", "success");
        window.loadCustomers();
    } catch (error) {
        console.error("Error deleting customer:", error);
        showToast("Error deleting customer", "error");
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Submit form
    document.getElementById('customer-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const saveBtnText = document.getElementById('save-btn-text');
        const spinner = document.getElementById('save-btn-spinner');
        const saveBtn = document.getElementById('save-customer-btn');

        saveBtnText.innerText = 'Saving...';
        spinner.classList.remove('hidden');
        saveBtn.disabled = true;

        try {
            const Customer = Parse.Object.extend("Customer");
            let customer;
            const id = document.getElementById('customer-id').value;

            if (id) {
                const query = new Parse.Query(Customer);
                customer = await query.get(id);
            } else {
                customer = new Customer();
            }

            customer.set("name", document.getElementById('customer-name').value);
            customer.set("location", document.getElementById('customer-location').value);
            customer.set("category", document.getElementById('customer-category').value);
            customer.set("status", document.getElementById('customer-status').value);
            customer.set("totalSpent", parseFloat(document.getElementById('customer-spent').value));

            await customer.save();

            showToast('Customer saved successfully!', 'success');
            window.closeCustomerModal();
            window.loadCustomers();

        } catch (error) {
            console.error('Error saving customer:', error);
            showToast('Error saving customer: ' + error.message, 'error');
        } finally {
            saveBtnText.innerText = 'Save';
            spinner.classList.add('hidden');
            saveBtn.disabled = false;
        }
    });

    window.loadCustomers = async function() {
        const spinner = document.getElementById('table-spinner');
        const tbody = document.getElementById('customer-table-body');

        if (!spinner || !tbody) return;

        spinner.classList.remove('hidden');
        tbody.innerHTML = '';

        try {
            const Customer = Parse.Object.extend("Customer");
            const query = new Parse.Query(Customer);
            query.descending("createdAt");
            const results = await query.find();

            if (results.length === 0) {
                document.getElementById('empty-state').classList.remove('hidden');
            } else {
                document.getElementById('empty-state').classList.add('hidden');

                let statuses = { 'Loyal': 0, 'New': 0, 'Recurring': 0, 'Inactive': 0 };

                results.forEach(customer => {
                    const status = customer.get("status") || 'New';
                    if (statuses[status] !== undefined) statuses[status]++;

                    const tr = document.createElement('tr');

                    function escapeHTML(str) {
                        return new Option(str).innerHTML;
                    }

                    let statusClass = 'bg-gray-100 text-gray-800';
                    if(status === 'Loyal') statusClass = 'bg-green-100 text-green-800';
                    if(status === 'New') statusClass = 'bg-blue-100 text-blue-800';
                    if(status === 'Recurring') statusClass = 'bg-purple-100 text-purple-800';
                    if(status === 'Inactive') statusClass = 'bg-red-100 text-red-800';

                    const safeName = escapeHTML(customer.get("name") || 'N/A');
                    const safeLocation = escapeHTML(customer.get("location") || 'N/A');
                    const safeCategory = escapeHTML(customer.get("category") || 'N/A');
                    const safeStatus = escapeHTML(status);

                    tr.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">${safeName}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${safeLocation}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${safeCategory}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">${safeStatus}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">$${(customer.get("totalSpent") || 0).toFixed(2)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="window.editCustomer('${customer.id}')" class="text-primary hover:text-blue-900 mr-3" title="Edit"><i class="fas fa-edit"></i></button>
                            <button onclick="window.deleteCustomer('${customer.id}')" class="text-red-600 hover:text-red-900" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

                // Update chart
                if(window.segmentationChart) {
                    window.segmentationChart.data.datasets[0].data = [
                        statuses['Loyal'], statuses['New'], statuses['Recurring'], statuses['Inactive']
                    ];
                    window.segmentationChart.update();
                }
            }
        } catch (error) {
            console.error("Error fetching customers:", error);
            showToast("Failed to load customers", "error");
        } finally {
            spinner.classList.add('hidden');
        }
    };

    window.loadCustomers();
});
