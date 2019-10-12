<template>
    <div class="ui small test modal">
        <div class="header">
            Create New Customer
        </div>
        <div class="content">
            <div class="ui form">
                <div class="tow field">
                    <div class="field">
                        <label style="text-align: left;">Name</label>
                    </div>
                    <div class="field">
                        <label>
                            <input type="text" v-model="customer.name" class="form-control" placeholder="Name">
                        </label>
                    </div>
                </div>

                <div class="tow field">
                    <div class="field">
                        <label style="text-align: left;">Phone</label>
                    </div>
                    <div class="field">
                        <label>
                            <input class="form-control" type="text" v-model="customer.phone" placeholder="Phone">
                        </label>
                    </div>
                </div>

                <div class="tow field">
                    <div class="field">
                        <label style="text-align: left;">Address</label>
                    </div>
                    <div class="field">
                        <label>
                            <textarea class="form-control" v-model="customer.address" placeholder="Address" rows="4"></textarea>
                        </label>
                    </div>
                </div>

            </div>
        </div>
        <div class="actions">
            <div class="ui negative button">
                Cancel
            </div>
            <a type="button" class="ui greenli button" @click="newCustomer()">Add</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateCustomer",
        data : function () {
            return {
                customer : {}
            }
        },
        methods: {
            newCustomer() {

            }
        }
    }
</script>

<style scoped>

</style>