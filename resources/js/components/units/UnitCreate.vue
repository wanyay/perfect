<template>
    <div class="masonry-item col-md-6 offset-3" style="position: absolute; left: 0%; top: 0px;">
        <div class="bgc-white p-20 bd"><h6 class="c-grey-900">Add New Unit</h6>
            <div class="mT-30">
                <el-form
                    :model="form"
                    :label-position="labelPosition"
                    label-width="100px"
                    :rules="rules"
                    ref="unitCreate">
                    <el-form-item label="Code" prop="code">
                        <el-input v-model="form.code"></el-input>
                    </el-form-item>
                    <el-form-item label="Description" prop="desp">
                        <el-input v-model="form.desp"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="submitForm('unitCreate')">Add</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "../../axios"
    export default {
        data() {
            return {
                labelPosition: 'left',
                form: {
                    code: '',
                    desp: ''
                },
                rules: {
                    code: [
                        { required: true, message: 'Please input Unit code', trigger: 'blur' }
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
                        axios.post('units.store', this.form).then(response => {
                            if (response.data.status == 'success') {
                                this.$message({
                                    message: 'Unit has been saved.',
                                    type: 'success'
                                });

                                this.$refs[formName].resetFields();
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
