export const permissionMixin = {
    methods: {
        $can(permissionName) {
          return Permissions.indexOf(permissionName) !== -1;
        }
    }
}
