import 'css/style.scss';
import ua from 'js/ua';
import resize from 'js/resize';
import intro  from 'js/intro';
import letter from 'js/letter';

window.onload = function () {
  const UA     = new ua();
  const RESIZE = new resize();
  const INTRO  = new intro();
  const LETTER = new letter();
};
