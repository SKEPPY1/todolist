
//Selectors
const todoInput = document.querySelector(".todo-input");
const todoButton = document.querySelector(".todo-button");
const todoList = document.querySelector(".todo-list");


// functions
// function addTodo(event){
//     buttonを押したときにフォームが送信しないようにしている
//     event.preventDefault();

//     const todoDiv = document.createElement("div");
//     const completedButton = document.createElement('button');
//     const newTodo = document.createElement('li');
//     const trashButton = document.createElement('button');

//     todoDiv.classList.add("todo");
//     completedButton.classList.add("complate-btn");
//     newTodo.classList.add('todo-item');
//     trashButton.classList.add("trash-btn");

//     newTodo.innerText = todoInput.value;
//     completedButton.innerHTML = '<i class="far fa-circle"></i>'
//     trashButton.innerHTML = '<i class="fas fa-trash-alt"></i>'

//     todoList.appendChild(todoDiv);
//     todoDiv.appendChild(completedButton);
//     todoDiv.appendChild(newTodo);
//     todoDiv.appendChild(trashButton);
//     todoInput.value = "";
// }

// todoButton.addEventListener("click", addTodo);





function Checkdelete(e){
    const item = e.target;

    if (item.classList[1] === "fa-trash-alt"){
        const todo = item.parentElement.parentElement;
        todo.classList.add("slide");
        todo.addEventListener('transitionend', function(){
            todo.remove();
        })
    }
}

//     if (item.classList[1] === "fa-circle"){
//         const todo = item.parentElement.parentElement;
//         todo.classList.toggle("completed");
//     }else if (item.classList[1] === "fa-trash-alt"){
//         const todo = item.parentElement.parentElement;
//         todo.classList.add("slide");
//         todo.addEventListener('transitionend', function(){
//             todo.remove();
//         })
//     }
// }

todoList.addEventListener('click', Checkdelete);



