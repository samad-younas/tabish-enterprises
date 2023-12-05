<template>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New Purchase</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="email" v-model="record.name" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter Name">
                    <small>
                        <span v-if="errors.name != null" class="text-danger">
                            {{errors.name[0]}}
                        </span>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">CNIC</label>
                    <input type="number" v-model="record.cnic" class="form-control" id="exampleInputPassword1"
                        placeholder="CNIC">
                    <small>
                        <span v-if="errors.cnic != null" class="text-danger">
                            {{errors.cnic[0]}}
                        </span>
                    </small>
                </div>
                <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control" v-model="record.currency" @change="changeCurrency()" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                        <option selected disabled>Please select</option>
                        <option v-for="currency in currencies" :value="currency">{{currency.currency_name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Amount</label>
                    <input type="number" v-model="record.amount" @input="calculateAmount()" class="form-control" id="exampleInputPassword1"
                        placeholder="Amount">
                    <small>
                        <span v-if="errors.amount != null" class="text-danger">
                            {{errors.amount[0]}}
                        </span>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sale Price</label>
                    <input type="number" v-model="record.sale_price" disabled class="form-control" id="exampleInputPassword1"
                        placeholder="sale_price">
                    <small>
                        <span v-if="errors.sale_price != null" class="text-danger">
                            {{errors.sale_price[0]}}
                        </span>
                    </small>
                </div>
                <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Currency</label>
                    <input type="number" v-model="record.currency" class="form-control" id="exampleInputPassword1"
                        placeholder="currency">
                    <small>
                        <span v-if="errors.currency != null" class="text-danger">
                            {{errors.currency[0]}}
                        </span>
                    </small>
                </div> -->
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Price</label>
                    <input type="number" v-model="record.total" class="form-control" id="exampleInputPassword1" disabled
                        placeholder="total_price">
                    <small>
                        <span v-if="errors.total_price != null" class="text-danger">
                            {{errors.total_price[0]}}
                        </span>
                    </small>
                </div>
            </div>

            <div class="card-footer">
                <button @click.prevent="submit()" type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Your Purchase are listed Below</h3>
            </div>

            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="form-group">
                            <label>Date range Search:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation">
                            </div>
                        </div>
                        <a style="height: 40px !important; margin:30px" @click="searchData()" class="btn btn-primary">Search</a>
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Name: activate to sort column ascending">
                                            Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CNIC: activate to sort column ascending">
                                            CNIC
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Currency: activate to sort column ascending">
                                            Currency
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Sale Price: activate to sort column ascending">
                                            Sale Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Amount: activate to sort column ascending">
                                            Amount</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Total: activate to sort column ascending">
                                            Total</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Action: activate to sort column ascending">Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(sale, index) in purchases" :key="index">
                                        <td class="dtr-control sorting_1" tabindex="0">{{index+1}}</td>
                                        <td>{{sale.name}}</td>
                                        <td>{{sale.cnic}}</td>
                                        <td>{{sale.currency.currency_name}}</td>
                                        <td>{{sale.amount}}</td>
                                        <td>{{sale.sale_price}}</td>
                                        <td>{{sale.total}}</td>
                                        <td><a @click="editPurchase(sale)"><i class="nav-icon fas fa-edit" style="color:blue"></i></a> <a
                                                @click="deletePurchase(sale.id)"><i class="nav-icon fas fa-trash" style="color: red;"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import axios from "axios";
    export default {
        data() {
            return {
                record: {
                    name: '',
                    cnic: '',
                    amount: '',
                    sale_price: '',
                    currency: '',
                    total: '',
                },
                currencies: [],
                purchases: [],
                errors: [],
                currentDate: null
            }
        },
        created() {
            this.getPurchase();
            this.getCurrency();
            this.$nextTick(()=>{
                $('#reservation').daterangepicker()
            })
        },
        mounted() {
            this.getCurrentDate();
        },
        methods: {
            getCurrentDate() {
                const today = new Date();
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                this.currentDate = today.toLocaleDateString(undefined, options);
            },
            searchData(){
                const inputElement = document.getElementById('reservation');
                axios.post('/purchase/search',{
                    date:  inputElement.value 
                })
                .then((res) => {
                    this.purchases = res.data
                })
            },
            changeCurrency(){
                this.record.sale_price = this.record.currency.sale_price
            },
            calculateAmount(){
                this.record.total = (this.record.sale_price) * (this.record.amount);
            },
            getCurrency() {
                axios.get('/currency/get')
                    .then((res) => {
                        this.currencies = res.data
                    })
            },
            getPurchase() {
                axios.get('/purchase/get')
                .then((res) => {
                    this.purchases = res.data;
                    const dataTable = $("#example1").DataTable();
                    if (dataTable) {
                        dataTable.destroy();
                    }

                    this.$nextTick(() => {
                        // Reinitialize DataTable
                        $("#example1").DataTable({
                            "responsive": true,
                            "lengthChange": false,
                            "autoWidth": false,
                            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                            "paging": true,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    });
                })
            },
            deletePurchase(id) {
                axios.get('/delete-purchase/' + id)
                    .then((res) => {
                        if (res.data.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Purchase Deleted",
                            });
                            this.getPurchase();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Something went wrong please reload the page and try again. Thanks",
                            });
                        }
                    })
            },
            submit() {
                axios.post('/save-udpate-purchase', this.record)
                    .then((res) => {
                        if (res.data.success == false) {
                            this.errors = res.data.errors;
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Data saved",
                            });
                            this.generateInvoice();
                            this.getPurchase();
                            this.clearForm();
                        }
                    })
                    .catch((error) => {
                        this.errors = error
                    });
            },
            generateInvoice(){
                var mywindow = window.open('', 'PRINT');
                mywindow.document.write(
                    '<div id="printable" style="border: font-family:monospace;"><div style="width: 100%; text-align:center;"><h1>TABISH ENTERPRISES</h1><div style="width: 100%; text-align:center;font-size: 12px;font-weight: bold;font-family:monospace">133 Circular Road Lahore<div>ph : 03350964001</div><table style="width:100%;text-align:center;margin-top:20px"><tr><td style="width:39%;text-align:left">Customer:' +
                    this.record.name +'<br>'+this.record.cnic+'</td><td style="border:1px solid;border-radius: 15px;">Purchase</td><td style="text-align:right"><br>Date: ' + this.currentDate +'</td></tr></table></div>')
                mywindow.document.write(
                    '<table style=" margin-top:20px;font-family:monospace;width: 100%;border-collapse: collapse;text-align:center" >')
                mywindow.document.write('<thead>')
                mywindow.document.write('<tr>')
                mywindow.document.write('<th style="border:1px dotted;border-collapse:collapse">#</th><th style="border:1px dotted;border-collapse:collapse">Currency</th><th style="border:1px dotted;border-collapse:collapse">Quantity</th><th style="border:1px dotted;border-collapse:collapse">Sale Price</th><th style="border:1px dotted;border-collapse:collapse">Total Amount</th>')
                mywindow.document.write('</tr>')
                mywindow.document.write('</thead>')
                mywindow.document.write('<tbody>')
                // item.detail.forEach(function (row, index) {
                    mywindow.document.write('<tr  style="border-bottom: 1px inset">')
                    mywindow.document.write('<td>' + 1 + '</td><td>' + this.record.currency.currency_name + '</td><td>' + this.record.amount +
                        '</td><td>' + this.record.sale_price + '</td><td>' + this.record.total +
                        '</td>');
                    mywindow.document.write('</tr>')
                // })

                mywindow.document.write('</tbody>')
                mywindow.document.write('<tfoot>')
                mywindow.document.write('<tr>')
                mywindow.document.write('<th colspan="4" style="text-align:right;padding-top:20px">Total</th><th style="padding-top:20px">' + this.record.total +
                    '</th>')
                // mywindow.document.write('</tr>')
                // mywindow.document.write('<tr>')
                // mywindow.document.write('<th colspan="4" style="text-align:right">Paid</th><th>' + item.paid +
                //     '</th>')
                // mywindow.document.write('</tr>')
                // mywindow.document.write('<tr>')
                // mywindow.document.write('<th colspan="4" style="text-align:right">Balance</th><th>' + (item.grandtotal - item.paid) +
                //     '</th>')
                mywindow.document.write('</tr>')
                mywindow.document.write('</tfoot>')
                mywindow.document.write('</table>')

                mywindow.document.write('<div style="margin-top: 50px; text-align:center"><table style="width:100%"><tr><td style="width: 10px;">Cashier</td><td style="border-bottom:1px solid;width: 30%;"></td><td></td><td style="width: 90px;margin-left: 157px;">Received By</td><td style="border-bottom:1px solid;width: 30%;"></td></tr></table></div>')
                mywindow.document.write('<div style="font-size:12px; margin-top: 50px; text-align:center">Software By ZylopyxCrew 03350964001</div>')
                mywindow.document.write('</div>')
                mywindow.document.write('<div class="page-break"></div>')
                // mywindow.document.write('<h1>' + document.title  + '</h1>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/

                mywindow.print();
                // mywindow.close();

                return true;
            },
            clearForm() {
                this.errors = [];
                this.record = {
                    name: '',
                    cnic: '',
                    amount: '',
                    sale_price: '',
                    currency: '',
                    total: '',
                };
            },
            editPurchase(item) {
                this.record.id = item.id
                this.record.name = item.name
                this.record.cnic = item.cnic
                this.record.currency = item.currency
                this.record.amount = item.amount
                this.record.sale_price = item.sale_price
                this.record.total = item.total
            }
        },
    }

</script>
