<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard — ScoopPOS</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        body { background-color: #f8fafc; color: #1e293b; }
        
        .top-nav { background: #ffffff; border-bottom: 1px solid #e2e8f0; height: 60px; padding: 0 32px; display: flex; justify-content: space-between; align-items: center; }
        .nav-brand { display: flex; align-items: center; gap: 10px; font-weight: 600; font-size: 15px; color: #0f172a; text-decoration: none; }
        .nav-brand svg { width: 18px; height: 18px; stroke: #2563eb; fill: none; stroke-width: 2; }
        
        .user-panel { display: flex; align-items: center; gap: 12px; font-size: 13px; }
        .role-pill { background: #fef3c7; color: #92400e; padding: 3px 10px; border-radius: 999px; font-weight: 500; font-size: 11px; text-transform: uppercase; }
        .btn-logout { color: #64748b; text-decoration: none; font-weight: 500; padding: 6px 12px; border-radius: 6px; border: 1px solid #cbd5e1; background: #ffffff; }
        .btn-logout:hover { background: #f1f5f9; color: #0f172a; }

        .main-container { max-width: 1200px; margin: 32px auto; padding: 0 24px; }
        
        .tab-bar { display: flex; gap: 24px; border-bottom: 1px solid #e2e8f0; margin-bottom: 28px; }
        .tab-btn { padding: 10px 0; font-size: 14px; font-weight: 500; color: #64748b; background: none; border: none; border-bottom: 2px solid transparent; margin-bottom: -1px; cursor: pointer; }
        .tab-btn.active { color: #2563eb; border-bottom-color: #2563eb; }

        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .section-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-title h2 { font-size: 16px; font-weight: 600; color: #0f172a; }
        
        .btn-action-main { background: #2563eb; color: #ffffff; border: none; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-action-main svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2.5; }
        
        .grid-inventory { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .item-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .item-category { font-size: 11px; font-weight: 600; color: #0284c7; background: #e0f2fe; padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 12px; text-transform: uppercase; }
        .item-name { font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 12px; }
        .item-details { display: flex; justify-content: space-between; font-size: 13px; color: #64748b; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
        .item-details strong { color: #334155; font-weight: 600; }
        
        .card-footer-actions { display: flex; gap: 8px; }
        .btn-sub { flex: 1; padding: 6px; border-radius: 4px; font-size: 12px; font-weight: 500; text-align: center; text-decoration: none; border: 1px solid transparent; cursor: pointer; background: none; }
        .btn-edit { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .btn-delete { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }

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
        .btn-modal-cancel { flex: 1; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 10px; border-radius: 6px; font-weight: 500; cursor: pointer; text-align: center; text-decoration: none; }
    </style>
</head>
<body>

<header class="top-nav">
    <a href="#" class="nav-brand">
        <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0"/></svg>
        ScoopPOS
    </a>
    <div class="user-panel">
        <span>John Doe</span>
        <span class="role-pill">Owner</span>
        <a href="index.html" class="btn-logout">Logout</a>
    </div>
</header>

<div class="main-container">
    <nav class="tab-bar">
        <button class="tab-btn active" onclick="switchTab(event, 'inventory-tab')">Inventory Catalog</button>
        <button class="tab-btn" onclick="switchTab(event, 'customer-tab')">Customer Records</button>
        <button class="tab-btn" onclick="switchTab(event, 'roles-tab')">System Roles & Access</button>
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
                    <button class="btn-sub btn-delete">Delete</button>
                </div>
            </div>
            <div class="item-card">
                <span class="item-category" style="background:#fef3c7; color:#b45309;">Vanilla</span>
                <div class="item-name">Classic French Vanilla</div>
                <div class="item-details">
                    <span>Price: <strong>$3.80</strong></span>
                    <span>Stock: <strong>60 units</strong></span>
                </div>
                <div class="card-footer-actions">
                    <button class="btn-sub btn-edit" onclick="openModal('editItemModal')">Edit</button>
                    <button class="btn-sub btn-delete">Delete</button>
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
                            <button class="btn-sub btn-delete" style="display:inline-block; width:auto; padding:4px 10px;">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 3: System Roles & Access -->
    <div id="roles-tab" class="tab-content">
        <div class="section-row">
            <div class="section-title"><h2>System User Accounts & Staff Access Control</h2></div>
            <button class="btn-action-main" onclick="openModal('addUserModal')">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Staff Account
            </button>
        </div>

        <div class="data-table-wrap">
            <div class="table-header-bar">Active Staff Accounts</div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Account Status</th>
                        <th style="text-align: right;">Permissions & Control</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sarah Jenkins</td>
                        <td>manager@scooppos.com</td>
                        <td><span class="role-pill" style="background:#dbeafe; color:#1e40af;">Manager</span></td>
                        <td><span style="color: #16a34a; font-weight: 500;">● Active</span></td>
                        <td style="text-align: right;">
                            <button class="btn-sub btn-edit" style="display:inline-block; width:auto; padding:4px 10px;" onclick="alert('Manage manager permissions')">Edit Access</button>
                            <button class="btn-sub btn-delete" style="display:inline-block; width:auto; padding:4px 10px;" onclick="confirm('Pause or revoke this manager account?')">Pause Account</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Tom Davis</td>
                        <td>cashier@scooppos.com</td>
                        <td><span class="role-pill" style="background:#dcfce7; color:#166534;">Cashier</span></td>
                        <td><span style="color: #16a34a; font-weight: 500;">● Active</span></td>
                        <td style="text-align: right;">
                            <button class="btn-sub btn-edit" style="display:inline-block; width:auto; padding:4px 10px;" onclick="alert('Manage cashier permissions')">Edit Access</button>
                            <button class="btn-sub btn-delete" style="display:inline-block; width:auto; padding:4px 10px;" onclick="confirm('Pause or revoke this cashier account?')">Pause Account</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODALS -->
<!-- 1. Add Item Modal -->
<div id="addItemModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Add New Inventory Item</h3>
            <button class="modal-close" onclick="closeModal('addItemModal')">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); closeModal('addItemModal'); alert('Item added successfully!');">
            <div class="form-group"><label>Item Name</label><input type="text" class="form-input" placeholder="e.g., Mint Choc Chip" required></div>
            <div class="form-group"><label>Category</label><input type="text" class="form-input" placeholder="e.g., Chocolate" required></div>
            <div class="form-group"><label>Price ($)</label><input type="number" step="0.01" class="form-input" placeholder="4.50" required></div>
            <div class="form-group"><label>Initial Stock Quantity</label><input type="number" class="form-input" placeholder="50" required></div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('addItemModal')">Cancel</button>
                <button type="submit" class="btn-modal-submit">Save Item</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Edit Item Modal -->
<div id="editItemModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Edit Inventory Item</h3>
            <button class="modal-close" onclick="closeModal('editItemModal')">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); closeModal('editItemModal'); alert('Item updated successfully!');">
            <div class="form-group"><label>Item Name</label><input type="text" class="form-input" value="Dark Fudge Delight" required></div>
            <div class="form-group"><label>Category</label><input type="text" class="form-input" value="Chocolate" required></div>
            <div class="form-group"><label>Price ($)</label><input type="number" step="0.01" class="form-input" value="4.50" required></div>
            <div class="form-group"><label>Stock Quantity</label><input type="number" class="form-input" value="45" required></div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('editItemModal')">Cancel</button>
                <button type="submit" class="btn-modal-submit">Update Item</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. Add Customer Modal -->
<div id="addCustomerModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Add New Customer Record</h3>
            <button class="modal-close" onclick="closeModal('addCustomerModal')">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); closeModal('addCustomerModal'); alert('Customer added successfully!');">
            <div class="form-group"><label>Full Name</label><input type="text" class="form-input" placeholder="Jane Doe" required></div>
            <div class="form-group"><label>Phone Number</label><input type="text" class="form-input" placeholder="+1 (555) 000-0000" required></div>
            <div class="form-group"><label>Initial Loyalty Points</label><input type="number" class="form-input" value="0"></div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('addCustomerModal')">Cancel</button>
                <button type="submit" class="btn-modal-submit">Save Customer</button>
            </div>
        </form>
    </div>
</div>

<!-- 4. Edit Customer Modal -->
<div id="editCustomerModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Edit Customer Record</h3>
            <button class="modal-close" onclick="closeModal('editCustomerModal')">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); closeModal('editCustomerModal'); alert('Customer updated successfully!');">
            <div class="form-group"><label>Full Name</label><input type="text" class="form-input" value="Alice Smith" required></div>
            <div class="form-group"><label>Phone Number</label><input type="text" class="form-input" value="+1 (555) 019-2831" required></div>
            <div class="form-group"><label>Loyalty Points</label><input type="number" class="form-input" value="120"></div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('editCustomerModal')">Cancel</button>
                <button type="submit" class="btn-modal-submit">Update Customer</button>
            </div>
        </form>
    </div>
</div>

<!-- 5. Add Staff User Modal -->
<div id="addUserModal" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            <h3>Add New Staff Account</h3>
            <button class="modal-close" onclick="closeModal('addUserModal')">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); closeModal('addUserModal'); alert('Staff account created successfully!');">
            <div class="form-group"><label>Full Name</label><input type="text" class="form-input" placeholder="Staff Name" required></div>
            <div class="form-group"><label>Email Address</label><input type="email" class="form-input" placeholder="staff@scooppos.com" required></div>
            <div class="form-group">
                <label>Assigned Role</label>
                <select class="form-input" required>
                    <option value="manager">Manager</option>
                    <option value="cashier">Cashier</option>
                </select>
            </div>
            <div class="form-group"><label>Password</label><input type="password" class="form-input" placeholder="••••••••" required></div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('addUserModal')">Cancel</button>
                <button type="submit" class="btn-modal-submit">Create Account</button>
            </div>
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
    function openModal(modalId) { document.getElementById(modalId).classList.add('open'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.remove('open'); }
</script>

</body>
</html>