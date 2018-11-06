<template>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>Login</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-text-field prepend-icon="person" name="email" v-model="email" label="E-Mail" :rules="emailRules"></v-text-field>
                        <v-text-field prepend-icon="lock" name="password" v-model="password" label="Password" type="password" :rules="requiredRules"></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :disabled="!valid" @click="submit" color="primary">Login</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import axios from 'axios'

    export default {
        data: () => ({
            valid: true,
            email: '',
            password: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid'
            ],
            requiredRules: [
                v => !!v || 'Field is required'
            ],
        }),

        methods: {
            submit () {
                if (this.$refs.form.validate()) {
                    // Native form submission is not yet supported
                    axios.post('/login', {
                        email: this.email,
                        password: this.password
                    })
                }
            },
            clear () {
                this.$refs.form.reset()
            }
        }
    }
</script>