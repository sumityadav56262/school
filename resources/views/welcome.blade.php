<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <h1>SCHOOL NAME</h1>
    </nav>
    <div class="container">
        <div class="menu">
            <div class="menu-item">
                <span class="material-icons">list_alt</span>
                <span>LIST OF RECORDS</span>
            </div>
            <div class="menu-item">
                <span class="material-icons">insert_chart_outlined</span>
                <span>DUES & REPORT</span>
            </div>
            <div class="menu-item">
                <span class="material-icons">history</span>
                <span>REPORT LIST</span>
            </div>
            <div class="menu-item">
                <span class="material-icons">receipt</span>
                <span>EXPENSES</span>
            </div>
            <div class="menu-item">
                <span class="material-icons">money</span>
                <span>MISCELLANEOUS</span>
            </div>
        </div>

        <div class="main-content">
            <div class="add-fees-section">
                <div class="add-fees-header">
                    ADD FEES
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="class">Class:</label>
                        <select id="class">
                            <option>PG -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="roll-no">Roll No:</label>
                        <input type="number" placeholder="Eg:- 1" id="roll-no" value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="adm-date">Adm. Date:</label>
                        <input type="text" id="adm-date">
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="text" id="date" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="month">Month:</label>
                        <select id="month">
                            <option>Baisakh</option>
                            <option>Jestha</option>
                            <option>Asar</option>
                            <option>Shrawan</option>
                            <option>Bhadra</option>
                            <option>Ashwin</option>
                            <option>Kartik</option>
                            <option>Mangsir</option>
                            <option>Poush</option>
                            <option>Magh</option>
                            <option>Falgun</option>
                            <option>Chaitra</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exam">Exam:</label>
                        <input type="text" id="exam">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="yearly">Yearly:</label>
                        <input type="number" id="yearly">
                    </div>
                    <div class="form-group">
                        <label for="tb">TB:</label>
                        <input type="text" id="tb">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="monthly">Monthly:</label>
                        <input type="number" id="monthly">
                    </div>
                    <div class="form-group">
                        <label for="vest">Vest:</label>
                        <input type="text" id="vest">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="eca">ECA:</label>
                        <input type="number" id="eca">
                    </div>
                    <div class="form-group">
                        <label for="computer">Computer:</label>
                        <input type="text" id="computer">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="game">Game:</label>
                        <input type="text" id="game">
                    </div>
                    <div class="form-group">
                        <label for="trouser">Trouser:</label>
                        <input type="text" id="trouser">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="misc-fee">Misc Fee:</label>
                        <input type="text" id="misc-fee">
                    </div>
                    <div class="form-group">
                        </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group">
                        <label for="total">Total:</label>
                        <input type="number" id="total" readonly>
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount:</label>
                        <input type="number" id="discount" placeholder="Eg: 100">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="payment">Payment:</label>
                        <input type="number" id="payment" placeholder="Eg: 1000">
                    </div>
                    <div class="form-group">
                        <label for="dues-add-fees">Dues:</label>
                        <input type="number" id="dues-add-fees" value="0" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="payment-by">Payment By:</label>
                        <input type="text" id="payment-by" placeholder="Eg: Sanjay Kumar">
                    </div>
                    <div class="form-group">
                        <label for="received-by">Received By:</label>
                        <input type="text" id="received-by" placeholder="Eg: SK Singh">
                    </div>
                </div>
                <div class="add-fees-footer">
                    <button>+</button>
                    <button class="reset-button"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iIzMzMyI+PHBhdGggZD0iTTEyIDZ2M2w0LTQtNC00djNjLTMuMzEgMC02IDIuNjktNiA2cyAyLjY5IDYgNiA2YzEuNjggMCAzLjI2LS42OCAgNC4zOS0xLjc4bDEuNDEgMS40MWMtMS44MyAxLjgzLTQuMzUgMi43OC03LjggMi43OC01LjUxIDAtMTAuMDEtNC40OS0xMC4wMS0xMC4wMSAwLTUuNTEgNC40OS0xMC4wMSAxMC4wMS0xMC4wMXoiLz48L3N2Zz4=" alt="Reset"> RESET</button>
                    <div class="previous-dues">
                        <input type="checkbox" id="previous-dues-checkbox">
                        <label for="previous-dues-checkbox">Previous Dues</label>
                        <input type="text" value="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="total-amount-section">
            <div class="total-amount-header">
                TOTAL AMOUNT
            </div>
            <div class="amount-row received">
                <label>RECEIVED:</label>
                <div class="amount-box">18000</div>
            </div>
            <div class="amount-row expenses">
                <label>EXPENSES:</label>
                <div class="amount-box">7150</div>
            </div>
            <div class="amount-row dues">
                <label>DUES:</label>
                <div class="amount-box">0</div>
            </div>
        </div>
    </div>
</body>
</html>