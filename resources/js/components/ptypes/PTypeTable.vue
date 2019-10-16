<template>

    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <a class="btn btn-primary btn-sm" style="float: right" href="/ptypes/create">Add New</a>
        <h4 class="c-grey-900 mB-20">Product Type</h4>
        <div class="dataTables_wrapper">
            <div class="dataTables_length" id="dataTable_length">
                <label>
                    Show
                    <select v-model="perPage"  name="dataTable_length" @change="handelPerPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    in {{total}}
                    entries
                </label>
            </div>
            <div id="dataTable_filter" class="dataTables_filter">
                <label>
                    Search:
                    <input type="search" v-model.lazy="keyword"
                           v-debounce="500" @change="handelSearch"  placeholder="Search Product Type">
                </label>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <tr v-if="ptypes.length < 0">
                    <td>
                        No Data.
                    </td>
                </tr>
                <tr v-for="ptype in ptypes">
                    <td v-html="highlight(ptype.code)"></td>
                    <td v-html="highlight(ptype.desp)"></td>
                    <td style="text-align: center;">
                        <a :href="'/ptypes/' + ptype.id + '/edit'"><i class="fas fa-edit"></i></a>
                        <a href="#" @click="deleteUnit(ptype.id)"><i class="fas fa-trash" style="color:red;"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <el-pagination
                @current-change="handleCurrentChange"
                @size-change = "handelPerPage"
                background
                layout="prev, pager, next"
                :page-size="parseInt(perPage)"
                :total='total'>
            </el-pagination>
        </div>
    </div>

</template>

<script>
    import axios from './../../axios';

    export default {
        name: "ptype-table",

        data: function () {
            return {
                ptypes: [],
                perPage: 10,
                sortable: 'created_at',
                sortType: 'desc',
                keyword: "",
                currentPage : 1,
                total : 0,
                dialogVisible : false
            }
        },

        mounted() {
            this.getPTypes();
        },

        methods: {
            getPTypes() {
                axios.get(
                    '/ptypes.search' + '?keyword=' + this.keyword + "&perPage=" + this.perPage
                    + "&sortable=" + this.sortable + "&sortType=" + this.sortType + "&page="
                    + this.currentPage
                ).then(response => {
                    this.currentPage = response.data.current_page;
                    this.total = response.data.total;
                    this.ptypes = response.data.data;
                });
            },
            handelSearch() {
                this.currentPage = 1;
                this.getPTypes();
            },
            handelPerPage() {
                this.currentPage = 1;
                this.getPTypes();
            },
            highlight(text) {
                return text.replace(new RegExp(this.keyword, 'gi'), '<span class="highlighted">$&</span>');
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getPTypes();
            },
            deleteUnit(id) {
                this.$confirm('This will permanently delete. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/ptypes.' + id + '.delete').then(
                        this.$message({
                            type: 'success',
                            message: 'Delete completed'
                        })
                    )
                    this.getPTypes();
                })
            }
        }
    }
</script>

<style scoped>
    table th, table td {
        padding: 0.5rem;
    }
    td a + a {
        padding-left: 2em;
    }
</style>
