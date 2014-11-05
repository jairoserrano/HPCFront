var ProjectFields = {
    "rules": {
        name: {
            required: true
        },
        description: {
            required: true
        }
    },
    "messages": {
        name: {
            required: "Hace falta colocar un nombre"
        },
        description: {
            required: "Hace falta agregar una descripción"
        }
    }
};

var CreateExecutableFields = {
    "rules": {
        name: {
            required: true
        },
        path:{
            required:true
        }
    },
    "messages": {
        name: {
            required: "Hace falta colocar un nombre"
        },
        path: {
            required: "Hace falta agregar ejecutable"
        }
    }
};

var EditExecutableFields = {
    "rules": {
        name: {
            required: true
        }
    },
    "messages": {
        name: {
            required: "Hace falta colocar un nombre"
        }
    }
};

var CreateJobFields = {
    "rules": {
        name: {
            required: true
        },
        executable_id:{
            valueNotEquals: 0
        },
        description: {
            required: true
        }

    },
    "messages": {
        name: {
            required: "Hace falta colocar un nombre"
        },
        description: {
            required: "Hace falta agregar una descripción"
        },
        executable_id:{
            valueNotEquals: "Debes escojer una opción"
        }
    }
};

var UpdateJobFields = {
    "rules": {},
    "messages": {}
};

var CreateEntryFields = {
    "rules": {},
    "messages": {}
};

var UpdateEntryFields = {
    "rules": {},
    "messages": {}
};
