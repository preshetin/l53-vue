<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
    <div>
            <div>
                <div class="panel panel-default" v-if="state == 'list'">
                    <div class="panel-heading">
                        Invoices<a class="pull-right action-link" @click="state='create'">Create New Invoice</a>
                    </div>

                    <div class="panel-body">
                        <!-- No Invoices Notice -->
                        <p class="m-b-none" v-if="invoices.length === 0">
                            You have not created any invoices.
                        </p>

                        <!-- Invoices -->
                        <table class="table table-borderless m-b-none" v-if="invoices.length > 0">
                            <thead>
                            <tr>
                                <th>Receipt</th>
                                <th>Amount</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="invoice in invoices">
                                <td style="vertical-align: middle;">
                                    {{ invoice.receipt }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ invoice.amount }}
                                </td>

                                <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="revoke(invoice)">
                                Delete
                                </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default" v-if="state == 'create'">
                    <div class="panel-heading">
                        Create Invoice<a class="pull-right action-link" @click="state='list'">Cancel</a>
                    </div>
                    <div class="panel-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="form.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in form.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Invoice Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="store">
                            <bill-item v-on:delete-row="deleteThisRow" v-for="row in form.receipt" v-bind:row="row"></bill-item>
                            <a @click="addRow">+</a>
                        </form>

                        <div>Summary: {{ summary }}</div>

                        <!-- Modal Actions -->
                        <div class="panel-footer">
                            <button type="button" class="btn btn-primary" @click="store">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</template>

<script>

    Vue.component('bill-item', {
        template: `
        <div>
            <input v-model="row.text"><input type="number" v-model="row.quantity"><input type="number" v-model="row.price"> {{ row.quantity * row.price }} <button @click="removeRow">x</button>
        </div>
        `,
        props: ['row'],
        methods: {
            removeRow() {
                this.$emit('delete-row');
            }
        }
    });

    export default {
        mounted() {
            console.log('Component ready.')
        },

        data() {
            return {
                invoices: [],
                state: "list",

                form: {
                    receipt: [
                        { text: '', quantity: null, price: null }
                    ],
                    amount: null,
                    errors: []
                }

            }
        },
        computed: {
            summary() {
                var sum = 0;
                var arrayLength = this.form.receipt.length;
                for (var i = 0; i < arrayLength; i++) {
                    sum += this.form.receipt[i].quantity * this.form.receipt[i].price;
                }
                this.form.amount = sum;
                return sum;
            }
        },


        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {

            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getInvoices();
            },

            /**
             * Get all invoices.
             */
            getInvoices() {
                this.$http.get('/invoices')
                        .then(response => {
                    this.invoices = response.data;
            });
            },

            addRow() {
                this.form.receipt.push({ text: '', quantity: null, price: null });
            },

            deleteThisRow(index) {
                this.form.receipt.splice(index, 1);
            },

            /**
             * Create a new invoice.
             */
            store() {
//                this.accessToken = null;

//                this.form.errors = [];

                this.$http.post('/invoices', this.form)
                        .then(response => {
//                    this.form.name = '';
//                this.form.scopes = [];
//                this.form.errors = [];
//
                this.invoices.push(response.data.invoice);
//
//                this.showAccessToken(response.data.accessToken);
                    this.state = 'list';
            })
            .catch(response => {
                    if (typeof response.data === 'object') {
                    this.form.errors = _.flatten(_.toArray(response.data));
                } else {
                    this.form.errors = ['Something went wrong. Please try again.'];
                }
            });
            },
        }

    }
</script>
