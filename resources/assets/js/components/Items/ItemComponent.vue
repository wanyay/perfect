<template>
    <div class="ui segments">
        <div class="ui segment">
            <h5 class="ui header">
                Item
            </h5>
        </div>
        <div class="ui segment">
            <div class="ui vertical fluid menu no-border no-radius">
                <div class="ui input">
                    <label for="bCode"></label>
                    <input id="bCode" v-model="searchKeyword" type="text" placeholder="Item Code"
                           style="padding-left:75px">
                </div>
                <div class="scroll_content">
                    <a >
                        @{{item.name}}
                    </a>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ItemComponent",

        data: function () {
            return {
                searchKeyword : ''
            }
        }
    }
</script>

<style scoped>

</style>