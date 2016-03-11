var name = 'Иван Марков';
var age = 25;

console.log('Меня зовут '+name+' Мне '+age+' лет');
age = name = undefined;
console.log(age);
console.log(name);

const SITY = 'Voronezh - константа';
if(window.SITY) {
    console.log(SITY);
}
else {
    console.log('Значение константы не существует');
}

//const SITY = 'Izhevsk - меняем константу';

var book = { title: 'Объектно-ориентированное программивание', author: 'Максим Кузнецов', pages:608 };
console.log('Недавно я прочитал книгу "'+ book.title +'", написанную автором '+ book.author +', я осилил все '+ book.pages +' страниц, мне она очень понравилась.');

var book3 = [{title:'Объектно-ориентированное программивание', author:"Максим Кузнецов",pages:608},{title:'PHP - 10 минут на урок',author:"Крис Ньюман",pages:255}];

console.log(
    'Недавно я прочитал книги "'+ book3[0].title +'" и "'+ book3[1].title +'", написанные соответственно авторами '+ book3[0].author +' и '+ book3[1].author +', я осилил в сумме '+(book3[0].pages + book3[1].pages)+' страниц, не ожидал от себя подобного.'
);