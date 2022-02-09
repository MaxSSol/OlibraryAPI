<template>
    <div>
        <admin-bar></admin-bar>
        <p class="fw-bold text-center">Users</p>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Test</th>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>
                    <a type="button" class="btn btn-primary">
                        <img src="https://img.icons8.com/fluency-systems-filled/20/000000/life-cycle-female.png"/>
                    </a>
                    <a class="btn btn-success">
                        <img src="https://img.icons8.com/windows/20/000000/remove-user-male--v1.png"/>
                    </a>
                    <a class="btn btn-danger">
                        <img src="https://img.icons8.com/windows/20/000000/remove-user-male--v1.png"/>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminBar from "../../headers/Admin-bar";
export default {
    name: "Users",
    components: {AdminBar},
}
</script>

<style scoped>

</style>
