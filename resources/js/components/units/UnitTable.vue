<template>

<div class="bgc-white bd bdrs-3 p-20 mB-20">
    <a class="btn btn-primary btn-sm" style="float: right" href="/units/create">Add New</a>
    <h4 class="c-grey-900 mB-20">Units</h4>
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
                       v-debounce="500" @change="handelSearch"  placeholder="Search Unit">
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
            <tr v-if="units.length < 0">
                <td>
                    No Data.
                </td>
            </tr>
            <tr v-for="unit in units">
                <td v-html="highlight(unit.code)"></td>
                <td v-html="highlight(unit.desp)"></td>
                <td style="text-align: center;">
                    <a :href="'/units/' + unit.id + '/edit'"><i class="fas fa-edit"></i></a>
                    <a href="#" @click="deleteUnit(unit.id)"><i class="fas fa-trash" style="color:red;"></i> </a>
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
        name: "unit-table",

        data: function () {
            return {
                units: [],
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
            this.getUnits();
        },

        methods: {
            getUnits() {
                axios.get(
                    '/units.search' + '?keyword=' + this.keyword + "&perPage=" + this.perPage
                    + "&sortable=" + this.sortable + "&sortType=" + this.sortType + "&page="
                    + this.currentPage
                ).then(response => {
                    this.currentPage = response.data.current_page;
                    this.total = response.data.total;
                    this.units = response.data.data;
                });
            },
            handelSearch() {
              this.currentPage = 1;
              this.getUnits();
            },
            handelPerPage() {
                this.currentPage = 1;
                this.getUnits();
            },
            highlight(text) {
                return text.replace(new RegExp(this.keyword, 'gi'), '<span class="highlighted">$&</span>');
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getUnits();
            },
            deleteUnit(id) {
                this.$confirm('This will permanently delete. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/units.' + id + '.delete').then(
                        this.$message({
                            type: 'success',
                            message: 'Delete completed'
                        })
                    )
                    this.getUnits();
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
