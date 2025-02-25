import React from 'react';
import {
  Create,
  SimpleForm,
  ReferenceInput,
  TextInput,
  SelectInput,
  ImageInput,
  ImageField,
  DateInput,

} from 'react-admin';

import RichTextInput from 'ra-input-rich-text';


const NewsCreate = props => (
  <Create {...props}>
    <SimpleForm>
      <ReferenceInput source="author" reference="profile/users">
        <SelectInput optionText="lastname" />
      </ReferenceInput>
      <TextInput source="title" />
      <RichTextInput source="content" />
      <ImageInput source="pictures" label="Related pictures" accept="image/*">
        <ImageField source="src" title="title" />
      </ImageInput>
    </SimpleForm>
  </Create>
);

export default NewsCreate;
