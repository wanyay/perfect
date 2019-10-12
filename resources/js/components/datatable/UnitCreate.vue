<template>
    <div class="masonry-item col-md-6 offset-3" style="position: absolute; left: 0%; top: 0px;">
        <div class="bgc-white p-20 bd"><h6 class="c-grey-900">Create Unit</h6>
            <div class="mT-30">
                <div class="alert alert-primary" role="alert">This is a primary alert—check it out!</div>
                <form>
                    <div class="form-group">
                        <label for="name">Code</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter Code"/>
                        <small v-if="errors.length > 0" class="form-text text-muted"> We'll never share your email with anyone else. </small>
                    </div>
                    <div class="form-group">
                        <label for="desp">Description</label>
                        <input type="text" class="form-control" id="desp" placeholder="Enter Description">
                    </div>
                    <el-button type="primary">Submit</el-button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors : [],
                form : {
                    code : "",
                    desp : ""
                }
            }
        }
    }
</script>

<style scoped>

</style>
