<template>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New Currency</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Currency Name</label>
                    <input type="email" v-model="record.currency_name" class="form-control" id="exampleInputEmail1" 
                        placeholder="Enter Currency Name">
                    <small>
                        <span v-if="errors.currency_name != null" class="text-danger">
                            {{errors.currency_name[0]}}
                        </span>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sale Price</label>
                    <input type="number" v-model="record.sale_price" class="form-control" id="exampleInputPassword1" step="0.01"
                        placeholder="Sale Price">
                    <small>
                        <span v-if="errors.sale_price != null" class="text-danger">
                            {{errors.sale_price[0]}}
                        </span>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Purchase Price</label>
                    <input type="number" v-model="record.purchase_price" class="form-control" id="exampleInputPassword1" step="0.01"
                        placeholder="Purchase Price">
                    <small>
                        <span v-if="errors.purchase_price != null" class="text-danger">
                            {{errors.purchase_price[0]}}
                        </span>
                    </small>
                </div>
            </div>

            <div class="card-footer">
                <button @click.prevent="submit()" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All currencies are listed below</h3>
            </div>

            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Currency name: activate to sort column ascending">Currency name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Sale Price: activate to sort column ascending">
                                            Sale Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Purchase Price: activate to sort column ascending">
                                            Purchase Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd" v-for="(currency, index) in currencies" :key="index">
                                        <td class="dtr-control sorting_1" tabindex="0">{{index+1}}</td>
                                        <td>{{currency.currency_name}}</td>
                                        <td>{{currency.sale_price}}</td>
                                        <td>{{currency.purchase_price}}</td>
                                        <td><a @click="editCurrency(currency)"><i class="nav-icon fas fa-edit" style="color:blue"></i></a> <a @click="deleteCurrency(currency.id)"><i class="nav-icon fas fa-trash" style="color: red;"></i></a></td>
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
                    currency_name: '',
                    sale_price: '',
                    purchase_price: ''
                },
                currencies: [],
                errors: [],
            }
        },
        created() {
            this.getData();
        },
        methods: {
            getData() {
                axios.get('/currency/get')
                .then((res) => {
                    this.currencies = res.data
                    const dataTable = $("#example1").DataTable();
                        if (dataTable) {
                            dataTable.destroy();
                        }
                        this.$nextTick(() => {
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
            deleteCurrency(id) {
                axios.get('/delete-currency/' + id)
                .then((res) => {
                    if(res.data.success == true){
                        Swal.fire({
                            icon: "success",
                            title: "CUrrency Deleted",
                        });
                        this.getData();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong please reload the page and try again. Thanks",
                        });
                    }
                })
            },
            submit() {
                axios.post('/save-udpate-currency', this.record)
                .then((res) => {
                    if (res.data.success == false) {
                        this.errors = res.data.errors;
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Data saved",
                            // text: "Something went wrong!",
                        });
                        this.clearForm()
                        this.getData()
                    }
                })
            },
            clearForm() {
                this.errors = [];
                this.record = {
                    currency_name: '',
                    sale_price: '',
                    purchase_price: ''
                };
            },
            editCurrency(item){
                this.record.id = item.id
                this.record.currency_name = item.currency_name
                this.record.sale_price = item.sale_price
                this.record.purchase_price = item.purchase_price
            }
        },
    }

</script>
