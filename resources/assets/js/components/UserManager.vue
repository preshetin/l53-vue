<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <!-- No Users Notice -->
                        <p class="m-b-none" v-if="users.length === 0">
                            You have not created any users.
                        </p>

                        <!-- Personal Access Users -->
                        <table class="table table-borderless m-b-none" v-if="users.length > 0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="user in users">
                                <td style="vertical-align: middle;">
                                    {{ user.name }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ user.email }}
                                </td>

                                <!-- Delete Button -->
                                <!--<td style="vertical-align: middle;">-->
                                    <!--<a class="action-link text-danger" @click="revoke(user)">-->
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
                users: []
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
                this.getUsers();
            },

            /**
             * Get all users.
             */
            getUsers() {
                this.$http.get('/users')
                        .then(response => {
                    this.users = response.data;
            });
            }
        }

    }
</script>
