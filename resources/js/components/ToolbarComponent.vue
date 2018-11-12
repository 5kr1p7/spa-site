<template>
    <div>
        <v-navigation-drawer v-model="drawer" absolute temporary>
            <v-list class="pa-1" v-show="isLogged">
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <img src="https://randomuser.me/api/portraits/men/85.jpg">
                    </v-list-tile-avatar>

                    <v-list-tile-content>
                        <v-list-tile-title>{{ username }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>

            <v-list class="pt-0" dense>
                <v-divider></v-divider>

                <v-list-tile  v-for="item in items" :key="item.title" v-show="isLogged == item.iflogged" :to="item.route">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Laravel</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-toolbar-items class="hidden-xs-only">
                <v-btn v-for="item in items" :key="item.title" v-show="isLogged == item.iflogged && !item.onlydrawer" :to="item.route" flat><v-icon left>{{ item.icon }}</v-icon>{{ item.title }}</v-btn>
                <!--
                <v-btn v-show="isLogged" flat href="/"><v-icon left>home</v-icon>Home</v-btn>
                <v-btn v-show="!isLogged" flat :to="{ name: 'login' }"><v-icon left>lock_open</v-icon>Login</v-btn>
                <v-btn v-show="!isLogged" flat href="/register"><v-icon left>assignment_ind</v-icon>Register</v-btn>
                -->

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
    </div>
</template>

<script>
    export default {
        data () {
            return {
                isLogged: false,
                username: '',

                drawer: null,
                items: [
                    { title: 'Home', icon: 'home', route: '/', iflogged: true },
                    { title: 'Login', icon: 'lock_open', route: '/login', iflogged: false },
                    { title: 'Register', icon: 'assignment_ind', route: '/', iflogged: false },
                    { title: 'Logout', icon: 'exit_to_app', route: '/', iflogged: true, onlydrawer: true, clicked: "logout()" },
                ]
            }
        },

        created() {
            this.getUsername()
        },

        mounted () {
            this.$nextTick(function () {
                this.$root.$on('loginChange', function (status) {
                    this.$refs.toolbar.isLogged = status
                    this.$refs.toolbar.getUsername()
                })
            })
        },

        methods: {
            signout () {
                this.$root.$emit('loginChange', false);
                this.$router.push('/');
            },

            logout () {
                axios.get('/logout').then(response => {
                    this.signout()
                })
            },

            getUsername() {
                axios.get('/api/user').then(( { data } ) => {
                    if (data[0]) {
                        this.username = data[0].name
                        this.isLogged = true
                    } else {
                        this.isLogged = false
                    }
                })
            }
        },
    }
</script>
