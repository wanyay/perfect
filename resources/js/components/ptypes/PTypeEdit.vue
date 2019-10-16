<template>
    <div class="masonry-item col-md-6 offset-3" style="position: absolute; left: 0%; top: 0px;">
        <div class="bgc-white p-20 bd"><h6 class="c-grey-900">Update Product Type</h6>
            <div class="mT-30">
                <el-form
                    :model="form"
                    :label-position="labelPosition"
                    label-width="100px"
                    :rules="rules"
                    ref="ptypeUpdate">
                    <el-form-item label="Name" prop="code">
                        <el-input v-model="form.code"></el-input>
                    </el-form-item>
                    <el-form-item label="Description" prop="desp">
                        <el-input v-model="form.desp"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="submitForm('ptypeUpdate')">Update</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "../../axios"
    export default {
        props: {'ptype': Object} ,
        data() {
            return {
                labelPosition: 'left',
                form: {
                    code: this.ptype.code,
                    desp: this.ptype.desp
                },
                rules: {
                    code: [
                        { required: true, message: 'Please input Name', trigger: 'blur' }
                    ],
                    desp: [
                        { required: true, message: 'Please input Description', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('ptypes.'+ this.ptype.id +'.update', this.form).then(response => {
                            if (response.data.status == 'success') {
                                this.$message({
                                    message: 'Product Type has been updated.',
                                    type: 'success'
                                });
                            }
                        });
                    } else {
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
