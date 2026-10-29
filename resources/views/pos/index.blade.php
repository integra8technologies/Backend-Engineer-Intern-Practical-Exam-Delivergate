<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScoopPOS — Enterprise Sign In</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 24px;
        }

        .auth-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .brand-logo {
            width: 38px;
            height: 38px;
            background: #2563eb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        .brand-logo svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-title h1 {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.025em;
        }

        .brand-title p {
            font-size: 13px;
            color: #64748b;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 6px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .role-option input {
            display: none;
        }

        .role-box {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.15s ease;
            background: #f8fafc;
        }

        .role-box svg {
            width: 18px;
            height: 18px;
            stroke: #64748b;
            stroke-width: 2;
            fill: none;
            margin-bottom: 4px;
        }

        .role-box span {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #475569;
        }

        .role-option input:checked + .role-box {
            border-color: #2563eb;
            background: #eff6ff;
        }

        .role-option input:checked + .role-box svg {
            stroke: #2563eb;
        }

        .role-option input:checked + .role-box span {
            color: #1d4ed8;
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .nav-links {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #64748b;
        }

        .nav-links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="brand-header">
        <div class="brand-logo">
            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0"/></svg>
        </div>
        <div class="brand-title">
            <h1>ScoopPOS System</h1>
            <p>Authentication Required</p>
        </div>
    </div>

    <form action="owner-dashboard.html" method="GET">
        <div class="field-group">
            <label>Select User Role</label>
            <div class="role-grid">
                <label class="role-option">
                    <input type="radio" name="role" value="owner" checked>
                    <div class="role-box">
                        <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <span>Owner</span>
                    </div>
                </label>
                <label class="role-option">
                    <input type="radio" name="role" value="manager">
                    <div class="role-box">
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        <span>Manager</span>
                    </div>
                </label>
                <label class="role-option">
                    <input type="radio" name="role" value="cashier">
                    <div class="role-box">
                        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        <span>Cashier</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="field-group">
            <label for="email">Work Email</label>
            <input type="email" id="email" class="form-input" placeholder="name@delivergate.com" required>
        </div>

        <div class="field-group" style="margin-bottom: 24px;">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-input" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-primary">Sign In</button>
    </form>

    <div class="nav-links">
        <span>Quick Previews:</span>
        <div>
            <a href="owner-dashboard.html">Owner</a> · 
            <a href="manager-dashboard.html">Manager</a> · 
            <a href="cashier-dashboard.html">Cashier</a>
        </div>
    </div>
</div>

</body>
</html>