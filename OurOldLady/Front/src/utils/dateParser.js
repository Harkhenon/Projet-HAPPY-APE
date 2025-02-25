const dateParser = (date) => {
  const returnedDate = {};

  const itemDay = new Date(date).getDay();
  const week = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']
  returnedDate.day = week[itemDay];

  const itemMonth = new Date(date).getMonth();
  const year = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
  returnedDate.month = year[itemMonth];

  returnedDate.dayNumber = new Date(date).getUTCDate();
  returnedDate.itemYear = new Date(date).getFullYear();

  return returnedDate;
};

export default dateParser;
