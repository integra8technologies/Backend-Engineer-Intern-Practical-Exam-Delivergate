<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard — ScoopPOS</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        
        .top-nav { background: #ffffff; border-bottom: 1px solid #e2e8f0; height: 60px; padding: 0 32px; display: flex; justify-content: space-between; align-items: center; }
        .nav-brand { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 15px; color: #0f172a; text-decoration: none; }
        .nav-brand svg { width: 18px; height: 18px; stroke: #2563eb; fill: none; stroke-width: 2; }
        
        .user-panel { display: flex; align-items: center; gap: 12px; font-size: 13px; }
        .role-pill { background: #dbeafe; color: #1e40af; padding: 3px 10px; border-radius: 999px; font-weight: 500; font-size: 11px; text-transform: uppercase; }
        .btn-logout { color: #64748b; text-decoration: none; font-weight: 500; padding: 6px 12px; border-radius: 6px; border: 1px solid #cbd5e1; background: #ffffff; }
        
        .main-container { max-width: 1200px; margin: 32px auto; padding: 0 24px; }
        .tab-bar { display: flex; gap: 24px; border-bottom: 1px solid #e2e8f0; margin-bottom: 28px; }
        .tab-btn { padding: 10px 0; font-size: 14px; font-weight: 500; color: #64748b; background: none; border: none; border-bottom: 2px solid transparent; margin-bottom: -1px; cursor: pointer; }
        .tab-btn.active { color: #2563eb; border-bottom-color: #2563eb; }
        .tab-btn.disabled { color: #cbd5e1; cursor: not-allowed; }

        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .section-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-title h2 { font-size: 16px; font-weight: 600; color: #0f172a; }
        
        .btn-action-main { background: #2563eb; color: #ffffff; border: none; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-action-main svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }
        
        .grid-inventory { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .item-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; }
        .item-category { font-size: 11px; font-weight: 600; color: #0284c7; background: #e0f2fe; padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 12px; text-transform: uppercase; }
        .item-name { font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 12px; }
        .item-details { display: flex; justify-content: space-between; font-size: 13px; color: #64748b; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
        .item-details strong { color: #334155; font-weight: 600; }
        
        .card-footer-actions { display: flex; gap: 8px; }
        .btn-sub { flex: 1; padding: 6px; border-radius: 4px; font-size: 12px; font-weight: 500; text-align: center; border: 1px solid transparent; cursor: pointer; background: none; }
        .btn-edit { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .btn-disabled { background: #f1f5f9; color: #94a3b8; border-color: #e2e8f0; cursor: not-allowed; }

        .data-table-wrap { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; margin-bottom: 30px; }
        .table-header-bar { padding: 16px 20px; font-size: 14px; font-weight: 600; border-bottom: 1px solid #e2e8f0; background: #f8fafc; display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
        th, td { padding: 12px 20px; border-bottom: 1px solid #f1f5f9; color: #334155; }
        th { font-weight: 600; color: #64748b; background: #fafafa; }

        /* Modal Styles */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 100; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal-card { background: #ffffff; width: 100%; max-width: 440px; border-radius: 10px; padding: 28px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .modal-header h3 { font-size: 16px; font-weight: 600; color: #0f172a; }
        .modal-close { background: none; border: none; font-size: 18px; cursor: pointer; color: #64748b; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 13px; font-weight: 500; color: #334155; margin-bottom: 6px; }
        .form-input { width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; outline: none; }
        .form-input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        .modal-actions { display: flex; gap: 10px; margin-top: 24px; }
        .btn-modal-submit { flex: 1; background: #2563eb; color: #ffffff; border: none; padding: 10px; border-radius: 6px; font-weight: 500; cursor: pointer; }
        .btn-modal-cancel { flex: 1; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 10px; border-radius: 6px; font-weight: 500; cursor: pointer; text-align: center; }
    </style>
</head>
<body>

<header class="top-nav">
    <a href="#" class="nav-brand">
        <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0"/></svg>
        ScoopPOS
    </a>
    <div class="user-panel">
        <span>Sarah Jenkins</span>
        <span class="role-pill">Manager</span>
        <a href="index.html" class="btn-logout">Logout</a>
    </div>
</header>

<div class="main-container">
    <nav class="tab-bar">
        <button class="tab-btn active" onclick="switchTab(event, 'inventory-tab')">Inventory Catalog</button>
        <button class="tab-btn" onclick="switchTab(event, 'customer-tab')">Customer Records</button>
        <button class="tab-btn disabled" title="Restricted to Owner">System Roles (Restricted)</button>
    </nav>

    <!-- Tab 1: Inventory -->
    <div id="inventory-tab" class="tab-content active">
        <div class="section-row">
            <div class="section-title"><h2>Inventory Management</h2></div>
            <button class="btn-action-main" onclick="openModal('addItemModal')">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add New Item
            </button>
        </div>

        <div class="grid-inventory">
            <div class="item-card">
                <span class="item-category">Chocolate</span>
                <div class="item-name">Dark Fudge Delight</div>
                <div class="item-details">
                    <span>Price: <strong>$4.50</strong></span>
                    <span>Stock: <strong>45 units</strong></span>
                </div>
                <div class="card-footer-actions">
                    <button class="btn-sub btn-edit" onclick="openModal('editItemModal')">Edit</button>
                    <span class="btn-sub btn-disabled" title="Delete restricted for managers">Delete (Restricted)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Customers -->
    <div id="customer-tab" class="tab-content">
        <div class="section-row">
            <div class="section-title"><h2>Customer Management</h2></div>
            <button class="btn-action-main" onclick="openModal('addCustomerModal')">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Customer
            </button>
        </div>

        <div class="data-table-wrap">
            <div class="table-header-bar">Customer Records Directory</div>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Loyalty Points</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#CUS-001</td>
                        <td>Alice Smith</td>
                        <td>+1 (555) 019-2831</td>
                        <td>120 pts</td>
                        <td style="text-align: right;">
                            <button class="btn-sub btn-edit" style="display:inline-block; width:auto; padding:4px 10px;" onclick="openModal('editCustomerModal')">Edit</button>
                            <span class="btn-sub btn-disabled" style="display:inline-block; width:auto; padding:4px 10px;">Delete (Restricted)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODALS -->
<div id="addItemModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header"><h3>Add New Inventory Item</h3><button class="modal-close" onclick="closeModal('addItemModal')">&times;</button></div>
        <form onsubmit="event.preventDefault(); closeModal('addItemModal'); alert('Item added!');">
            <div class="form-group"><label>Item Name</label><input type="text" class="form-input" required></div>
            <div class="form-group"><label>Category</label><input type="text" class="form-input" required></div>
            <div class="form-group"><label>Price ($)</label><input type="number" step="0.01" class="form-input" required></div>
            <div class="form-group"><label>Stock</label><input type="number" class="form-input" required></div>
            <div class="modal-actions"><button type="button" class="btn-modal-cancel" onclick="closeModal('addItemModal')">Cancel</button><button type="submit" class="btn-modal-submit">Save</button></div>
        </form>
    </div>
</div>

<div id="editItemModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header"><h3>Edit Inventory Item</h3><button class="modal-close" onclick="closeModal('editItemModal')">&times;</button></div>
        <form onsubmit="event.preventDefault(); closeModal('editItemModal'); alert('Item updated!');">
            <div class="form-group"><label>Item Name</label><input type="text" class="form-input" value="Dark Fudge Delight" required></div>
            <div class="form-group"><label>Price ($)</label><input type="number" step="0.01" class="form-input" value="4.50" required></div>
            <div class="form-group"><label>Stock</label><input type="number" class="form-input" value="45" required></div>
            <div class="modal-actions"><button type="button" class="btn-modal-cancel" onclick="closeModal('editItemModal')">Cancel</button><button type="submit" class="btn-modal-submit">Update</button></div>
        </form>
    </div>
</div>

<div id="addCustomerModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header"><h3>Add Customer</h3><button class="modal-close" onclick="closeModal('addCustomerModal')">&times;</button></div>
        <form onsubmit="event.preventDefault(); closeModal('addCustomerModal'); alert('Customer added!');">
            <div class="form-group"><label>Full Name</label><input type="text" class="form-input" required></div>
            <div class="form-group"><label>Phone Number</label><input type="text" class="form-input" required></div>
            <div class="modal-actions"><button type="button" class="btn-modal-cancel" onclick="closeModal('addCustomerModal')">Cancel</button><button type="submit" class="btn-modal-submit">Save</button></div>
        </form>
    </div>
</div>

<div id="editCustomerModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header"><h3>Edit Customer</h3><button class="modal-close" onclick="closeModal('editCustomerModal')">&times;</button></div>
        <form onsubmit="event.preventDefault(); closeModal('editCustomerModal'); alert('Customer updated!');">
            <div class="form-group"><label>Full Name</label><input type="text" class="form-input" value="Alice Smith" required></div>
            <div class="form-group"><label>Phone Number</label><input type="text" class="form-input" value="+1 (555) 019-2831" required></div>
            <div class="modal-actions"><button type="button" class="btn-modal-cancel" onclick="closeModal('editCustomerModal')">Cancel</button><button type="submit" class="btn-modal-submit">Update</button></div>
        </form>
    </div>
</div>

<script>
    function switchTab(evt, tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        evt.currentTarget.classList.add('active');
    }
    function openModal(id) { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }
</script>
</body>
</html>