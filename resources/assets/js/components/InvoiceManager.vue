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
                <div class="panel fffff panel-default" v-if="state == 'create'">
                    <div class="panel-heading">
                        Create Invoice<a class="pull-right action-link" @click="state='list'">Cancel</a>
                    </div>
                    <div class="panel-body">
                        <h1>Create form</h1>
                    </div>
                </div>
            </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component ready.')
        },

        data() {
            return {
                invoices: [],
                state: "list",

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
            }
        }

    }
</script>
