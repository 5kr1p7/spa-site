<template>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>Login</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-text-field prepend-icon="person" name="email" v-model="form.email" label="E-Mail" :rules="emailRules"></v-text-field>
                        <v-text-field prepend-icon="lock" name="password" v-model="form.password" label="Password" type="password" :rules="requiredRules"></v-text-field>
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
            form: {
                email: 'alex@alexshangin.ru',
                password: 'qaz123qaz',
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
                    // Native form submission is not yet supported
                    axios.get('/api/getcsrf').then(({ data }) => {
                        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = data
                    }).then(
                    axios.post('/login', this.form)
                        .then(response => {
                            //console.log('Response: ', response)
                            /*
                            let responseData = response.data.data
                            this.$localStorage.set('access_token', responseData.token)
                            */
                            this.$root.$emit('loginChange', true);
                            this.$router.push('/')

                        })
                        .catch(error => {
                            if (error.response) {
                                console.log(error.response.data)
                                console.log(error.response.status)
                                console.log(error.response.headers)
                            }
                        })
                    )
                }
            },
            clear () {
                this.$refs.form.reset()
            }
        }
    }
</script>