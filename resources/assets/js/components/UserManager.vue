<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users
                    <a class="pull-right action-link">Create New User</a>
                    </div>

                    <div class="panel-body">
                        <!-- No Users Notice -->
                        <p class="m-b-none" v-if="users.length === 0">
                            You have not created any users.
                        </p>

                        <!-- Personal Access Users -->
                        <table class="table table-borderless m-b-none" v-if="users.length > 0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="user in users">
                                <td style="vertical-align: middle;">
                                    {{ user.id }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ user.name }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ user.email }}
                                </td>

                                <td style="vertical-align: middle;">
                                    <a class="action-link text-danger">
                                        Delete
                                    </a>
                                </td>
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
