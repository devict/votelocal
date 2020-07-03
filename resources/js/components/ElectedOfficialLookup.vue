<template>
    <input
        type="text"
        name="address"
        id="address"
        class="border border-black m-4"
        v-model="input.address"
        @keyup.enter="submit"
    />
</template>

<script>
export default {
    data() {
        return {
            input: {
                address: '',
            },
            api: {
                endpoint:
                    'https://www.googleapis.com/civicinfo/v2/representatives',
                key: 'AIzaSyCWFfPa90ifFbT8HiSPkb1VjPfWECGHkro',
            },
        };
    },

    methods: {
        submit() {
            window.axios
                .get(this.api.endpoint, {
                    headers: {
                        Accept: 'application/json',
                    },
                    params: {
                        key: this.api.key,
                        address: this.input.address,
                    },
                })
                .then(response => {
                    console.dir(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>

<style>
</style>