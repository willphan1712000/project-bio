import { useState } from 'react';
import languages from '.';
import Language, { types } from './interface';

type T = keyof typeof languages;
let languageType = localStorage.getItem('language') as T;

if (!types.includes(languageType)) {
    languageType = 'en';
}

const storedLanguage = languages[languageType];

const appUseLanguage = () => {
    return useState<Language>(storedLanguage);
};

export default appUseLanguage;
