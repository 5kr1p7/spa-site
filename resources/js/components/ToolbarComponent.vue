<template>
    <v-toolbar color="indigo" dark fixed app>
        <v-toolbar-title>Laravel</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-xs-only">
            <v-btn @click.prevent="toggle" flat>Test</v-btn>
            <v-btn v-if="isLogged" flat href="/"><v-icon left>home</v-icon>Home</v-btn>
            <v-btn v-if="!isLogged" flat :to="{ name: 'login' }"><v-icon left>lock_open</v-icon>Login</v-btn>
            <v-btn v-if="!isLogged" flat href="/register"><v-icon left>assignment_ind</v-icon>Register</v-btn>

            <v-menu v-if="isLogged" offset-y>
                <v-btn flat slot="activator">
                    <span><v-icon left>person</v-icon>{{ user.name }}</span>
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
                testVar: true,
                //isLogged: this.checkIfIsLogged()
            }
        },

        mounted () {
            this.$root.$on('login-change', function (status) {
                console.log('-- Before status was '+this.isLogged)
                console.log('-- I got status '+status)
                this.isLogged = status
                console.log('-- Now status is '+this.isLogged)
                status ? console.log('Logged in') : console.log('Logged out')
            })
        },

        methods: {
            toggle () {
                this.isLogged = !this.isLogged
                console.log(this.isLogged)
            },
            signout () {
                this.$root.$emit('login-change', false);
                this.$router.push('/');
            },
            logout () {
                axios.get('/logout');
                this.signout()
            },
        },
    }
</script>
