<template>
    <v-toolbar color="indigo" dark fixed app>
        <v-toolbar-title>Laravel</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-xs-only">
            <v-btn flat v-if="user" href="/"><v-icon left>home</v-icon>Home</v-btn>
            <v-btn v-if="!user" flat :to="{ name: 'login' }"><v-icon left>lock_open</v-icon>Login</v-btn>
            <v-btn v-if="!user" flat href="/register"><v-icon left>assignment_ind</v-icon>Register</v-btn>

            <v-menu v-if="user" offset-y>
                <v-btn flat slot="activator">
                    <span><v-icon left>person</v-icon>{{ user.name }}</span>
                    <v-icon dark>arrow_drop_down</v-icon>
                </v-btn>

                <v-list>
                    <v-list-tile href="/logout">
                        <v-list-tile-title><v-icon left>exit_to_app</v-icon>Logout</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    export default {
        props: [
            'user',
        ],
    }
</script>
