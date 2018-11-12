<template>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                    <v-toolbar-title><v-icon left>vpn_key</v-icon> Login</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-text-field prepend-icon="person" name="email" v-model="form.email" label="E-Mail" :rules="emailRules"></v-text-field>
                        <v-text-field prepend-icon="lock" name="password" v-model="form.password" label="Password" type="password" :rules="requiredRules" @click:append="show1 = !show1" :type="show1 ? 'text' : 'password'" :append-icon="show1 ? 'visibility_off' : 'visibility'"></v-text-field>
                        <v-checkbox :label="`Remember me`" color="primary" name="remember" v-model="form.remember"></v-checkbox>
                    </v-form>
                </v-card-text>
                <v-layout justify-center>
                    <v-card-actions>
                            <v-btn :disabled="!valid" @click.prevent="submit" color="primary">Login</v-btn>
                            <v-btn @click="clear" color="primary">Clear</v-btn>
                    </v-card-actions>
                </v-layout>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import axios from 'axios'

    export default {
        data: () => ({
            valid: true,
            show1: false,
            form: {
                email: 'alex@alexshangin.ru',
                password: 'qaz123qaz',
                remember: 0,
            },
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
            ],
            requiredRules: [
                v => !!v || 'Field is required'
            ],
        }),

        methods: {

            submit (event) {
                if (this.$refs.form.validate()) {
                    axios.get('/api/getcsrf').then((data) => {
                        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = data.data
                    }).then((resp) => {
                        axios.post('/login', this.form)
                            .then(response => {
                                this.$root.$emit('loginChange', true);
                                this.$router.push('/')
                            })
                        }
                    )
                }
            },

            clear () {
                this.$refs.form.reset()
            },

            getLoggedStatus () {
                return this.$refs.toolbar.isLogged
            }
        }
    }
</script>