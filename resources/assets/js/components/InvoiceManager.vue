<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Invoices</div>

                    <div class="panel-body">
                        <!-- No Invoices Notice -->
                        <p class="m-b-none" v-if="invoices.length === 0">
                            You have not created any invoices.
                        </p>

                        <!-- Invoices -->
                        <table class="table table-borderless m-b-none" v-if="invoices.length > 0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="invoice in invoices">
                                <td style="vertical-align: middle;">
                                    {{ invoice.name }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ invoice.email }}
                                </td>

                                <!-- Delete Button -->
                                <!--<td style="vertical-align: middle;">-->
                                <!--<a class="action-link text-danger" @click="revoke(invoice)">-->
                                <!--Delete-->
                                <!--</a>-->
                                <!--</td>-->
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
                invoices: []
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
