<template>
    <div>
        <admin-bar></admin-bar>
        <p class="fw-bold text-center">Authors</p>
        <div class="book-create text-end mt-2">
            <a class="btn btn-primary">
                Add a author
            </a>
        </div>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Test</th>
                <td>Test</td>
                <td>Test</td>
                <td>
                    <a class="btn btn-primary">
                        <img src="https://img.icons8.com/ios-filled/20/000000/update-left-rotation.png"/>
                    </a>
                    <a class="btn btn-danger">
                        <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
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
    name: "Authors",
    components: {AdminBar}
}
</script>

<style scoped>

</style>
