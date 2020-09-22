<template>
    <div class="ui segment">
        <div class="ui search">
            <el-row :gutter="20">
                <el-col :span="6" :offset="18">
                    <el-input placeholder="Please input" v-model="search" class="input-with-select" id="search">
                        <el-button slot="append" icon="el-icon-search" @click="searchItem(1)"></el-button>
                    </el-input>
                </el-col>
            </el-row>

            <div class="results"></div>
        </div>
        <div style="height: 20px">

        </div>
        <div class="table-responsive">
            <el-table
                v-loading="loading"
                border
                :data="items"
                style="width: 100%">
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="code"
                    label="Code">
                </el-table-column>
                <el-table-column
                    align="left"
                    header-align="left"
                    prop="name"
                    label="Name">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="qty"
                    width="100"
                    label="Quantity">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="price"
                    width="100"
                    label="Price">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    prop="cost"
                    width="100"
                    label="Cost">
                </el-table-column>
                <el-table-column
                    align="center"
                    header-align="center"
                    label="Action">
                    <template slot-scope="scope">
                        <a :href="'/items/' + scope.row.id + '/barcode'" ><i class="barcode icon"></i></a>
                        <a :href="'/inventory/' + scope.row.id " ><i class="eye icon"></i></a>

                        <a :href="'/items/' + scope.row.id + '/edit'"><i class="edit icon"></i></a>

                        <a @click.prevent="deleteItem(scope.row.id)"><i class="red trash icon"></i> </a>
                    </template>
                </el-table-column>
            </el-table>
            <div style="height: 20px"></div>
            <el-pagination
                :disabled="loading"
                background
                layout="prev, pager, next"
                :total="total"
                @current-change="handleCurrentChange"
            >
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                search: '',
                pageCount: 1,
                total: 0,
                loading: false
            }
        },
        mounted() {
            this.getItemList(1);
        },
        methods: {
            getItemList(page) {
                this.loading = true;
                axios.get('/api/items?search=' + this.search +"&page=" + page)
                    .then(response => {
                        this.items = response.data.data;
                        this.total = response.data.total;
                        this.loading = false;
                    });
            },
            handleCurrentChange(page) {
                this.getItemList(page)
            },
            searchItem() {
                this.getItemList(1);
            },
            deleteItem(id) {
                this.$swal({
                    title: "Delete this status?",
                    text: "Are you sure? You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Yes, Delete it!",
                    icon: "warning"
                }).then(result => {
                    if (result.value) {
                        axios.delete('/api/items', {
                            data : {
                                item_id: id
                            }
                        }).then(response => {
                            if(response.status === 200) {
                                this.$swal({
                                    title: "Success",
                                    text: "Item has been deleted.",
                                    confirmButtonText: "OK",
                                    icon: "success"
                                }).then((response) => {
                                    location.reload();
                                });
                            }
                        }).catch(err => {
                            this.$swal({
                                title: "Error",
                                text: "Whoops! look like something went wrong.",
                                confirmButtonText: "OK",
                                icon: "error"
                            }).then((response) => {
                                location.reload();
                            });
                        })
                    }
                });
            },
        }
    }
</script>
