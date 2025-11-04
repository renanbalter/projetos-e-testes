class Expense {
    constructor(year, month, day, type, description, value) {
        this.year = year;
        this.month = month;
        this.day = day;
        this.type = type;
        this.description = description;
        this.value = value;

    }

    validateData() {
        for(let i in this) {
            if(this[i] == null || this[i] === '') {
                alert("Preencha todos os campos.");
                return false;
            }
        }
        return true;
    }
}

class Db {

    constructor() {
        let id = localStorage.getItem('id');

        if(id) {
            localStorage.setItem('id', id++);
        } else {
            localStorage.setItem('id', 0);
        }
    }

    getNextId() {
        let nextId = localStorage.getItem('id');

        console.log(parseInt(nextId) + 1);
        nextId = parseInt(nextId) + 1;

        return nextId;
    }

    storeExpense(e) {
    let id = this.getNextId();

    if(!id){
        id = 1;
    }

    localStorage.setItem(id ,JSON.stringify(e));
    localStorage.setItem('id', id)

    }

    registerExpense() {

    let year = document.getElementById("year");
    let month = document.getElementById("month");
    let day = document.getElementById("day");
    let type = document.getElementById("type");
    let description = document.getElementById("description");
    let number = document.getElementById("number");

    console.log(year.value, month.value, day.value, type.value, description.value ,number.value);

    let expense = new Expense(
        year.value,
        month.value,
        day.value,
        type.value,
        description.value,
        number.value
        );

    if(expense.validateData()) {
        db.storeExpense(expense);

        alert("Valor adicionado com sucesso!")
        document.getElementById("year").value = "";
        document.getElementById("month").value = "";
        document.getElementById("day").value = "";
        document.getElementById("type").value = "";
        document.getElementById("description").value = "";
        document.getElementById("number").value = "";
        
    }

    console.log(expense);
    }


    getAllExpenses() {
        let id = localStorage.getItem('id')
        let expenses = [];

        for (let i = 1; i <= id; i++) {
            let expense = JSON.parse(localStorage.getItem(i));
            if(expense && expense != null && expense != "") {
            expense.id = i;
            expenses.push(expense);
            }
        }    
        console.log(expenses);
        return expenses;
    }


    search(expense) {
        let filteredExpenses = [];
        filteredExpenses = this.getAllExpenses();

        if(expense.year) {
        console.log("yearfilter");
        filteredExpenses = filteredExpenses.filter(e => e.year == expense.year);
        }

        if(expense.month) {
        console.log("monthfilter");
        filteredExpenses = filteredExpenses.filter(e => e.month == expense.month);
        }

        if(expense.day) {
        console.log("dayfilter");
        filteredExpenses = filteredExpenses.filter(e => e.day == expense.day);
        }

        if(expense.type) {
        console.log("typefilter");
        filteredExpenses = filteredExpenses.filter(e => e.type == expense.type);
        }

        if(expense.description) {
        console.log("descriptionfilter");
        filteredExpenses = filteredExpenses.filter(e => e.description == expense.description);
        }

        if(expense.number) {
        console.log("numberfilter");
        filteredExpenses = filteredExpenses.filter(e => e.number == expense.number);
        }

        if(expense.id) {
        console.log("idfilter");
        filteredExpenses = filteredExpenses.filter(e => e.id == expense.id);
        }

        return filteredExpenses;

    }


}
let db = new Db;

function loadExpenseList() {
    let expenses = db.getAllExpenses();
    let table = document.getElementById("table-body");

    expenses.forEach(i => {
        let row = table.insertRow();
        console.log(i);
        

        row.insertCell(0).innerHTML = `${i.day}/${i.month}/${i.year}`;
        switch (i.type) {
            case '1':
                i.type = 'Alimentação'
                break;

            case '2':
                i.type = 'Educação'
                break;
            case '3':
                i.type = 'Lazer'
                break;
            case '4':
                i.type = 'Saúde'
                break;
            case '5':
                i.type = 'Transporte'
                break;
            default:
                break;
        }
    
        row.insertCell(1).innerHTML = `${i.type}`
        row.insertCell(2).innerHTML = `${i.description}`
        row.insertCell(3).innerHTML = `${i.value}`
        let btn = document.createElement("button")
        btn.className = "removebtn"
        btn.innerHTML = "X"
        btn.id = i.id;
        btn.onclick = function() {
            alert("Item removido com sucesso!")
            localStorage.removeItem(i.id);
            table.innerHTML = "";
            loadExpenseList();
        }
        row.insertCell(4).append(btn);

        
    });
} 

function searchExpense(expense) {
        let year = document.getElementById("year");
        let month = document.getElementById("month");
        let day = document.getElementById("day");
        let type = document.getElementById("type");
        let description = document.getElementById("description");
        let number = document.getElementById("number");

        expense = new Expense(
        year.value,
        month.value,
        day.value,
        type.value,
        description.value,
        number.value
        );

        let expenses = db.search(expense);
        let table = document.getElementById("table-body");
        table.innerHTML = '';


        console.log(expense);

        console.log(db.search(expense));


        expenses.forEach(i => {
        let row = table.insertRow();

        row.insertCell(0).innerHTML = `${i.day}/${i.month}/${i.year}`;
        switch (i.type) {
            case '1':
                i.type = 'Alimentação'
                break;
            case '2':
                i.type = 'Educação'
                break;
            case '3':
                i.type = 'Lazer'
                break;
            case '4':
                i.type = 'Saúde'
                break;
            case '5':
                i.type = 'Transporte'
                break;
            default:
                break;
        }
    
        row.insertCell(1).innerHTML = `${i.type}`
        row.insertCell(2).innerHTML = `${i.description}`
        row.insertCell(3).innerHTML = `${i.value}`
        row.insertCell(4).innerHTML = `${i}`
        
    });



}





