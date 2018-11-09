<template>
    <v-toolbar color="indigo" dark fixed app>
        <v-toolbar-title>Laravel</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-xs-only">
            <v-btn v-if="isLogged" flat href="/"><v-icon left>home</v-icon>Home</v-btn>
            <v-btn v-if="!isLogged" flat :to="{ name: 'login' }"><v-icon left>lock_open</v-icon>Login</v-btn>
            <v-btn v-if="!isLogged" flat href="/register"><v-icon left>assignment_ind</v-icon>Register</v-btn>

            <v-menu v-if="isLogged" offset-y>
                <v-btn flat slot="activator">
                    <span><v-icon left>person</v-icon>{{ username }}</span>
                    <v-icon dark>arrow_drop_down</v-icon>
                </v-btn>

                <v-list>
                    <v-list-tile @click.prevent="logout()">
                        <v-list-tile-title><v-icon left>exit_to_app</v-icon>Logout</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    export default {
        data () {
            return {
                isLogged: false,
                username: '',
            }
        },

        mounted () {
            this.$nextTick(function () {
                this.$root.$on('loginChange', function (status) {
                    this.$refs.toolbar.isLogged = status
                })
                this.getUsername()
            })
        },

        methods: {
            toggle () {
                this.isLogged = !this.isLogged
                console.log(this.isLogged)
            },
            signout () {
                this.$root.$emit('loginChange', false);
                this.$router.push('/');
            },
            logout () {
                axios.get('/logout');
                this.signout()
            },
            getUsername() {
                axios.get('/api/user').then(( { data } ) => {
                    this.username = data[0].name
                    this.isLogged = true
                }).catch((error) => {
                    this.username = ''
                    this.isLogged = false
                })
            }
        },
    }
</script>
