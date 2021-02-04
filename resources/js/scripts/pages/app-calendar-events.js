var date = new Date();
var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

async function fetchAsync(url) {
  let response = await fetch(url);
  let data = await response.json();
  return data;
}

  // var events = [
  //   {
  //     id: 1,
  //     url: '',
  //     title: 'Design Review',
  //     start: date,
  //     allDay: false,
  //     extendedProps: {
  //       calendar: 'Business'
  //     }
  //   }
  // ];