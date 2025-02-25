import React from 'react';
import {
  List,
  Datagrid,
  TextField,
  EmailField,
  Filter,
  TextInput,
  ReferenceInput,
  SelectInput,
  SimpleList,
  Responsive,
  ShowButton,
} from 'react-admin';

const ContactFilter = props => (
  <Filter {...props}>
    <TextInput label="Search" source="q" alwaysOn />
    <ReferenceInput label="User" source="userId" reference="profile/contact" allowEmpty>
      <SelectInput optionText="name" />
    </ReferenceInput>
  </Filter>
);

const ContactList = props => (
  <List filters={<ContactFilter />} {...props}>
    <Responsive
      small={(
        <SimpleList
          primaryText={record => record.title}
          secondaryText={record => `${record.views} views`}
          tertiaryText={record => new Date(record.published_at).toLocaleDateString()}
        />
  )}
      medium={(
        <Datagrid rowClick="edit">
          <TextField source="lastname" />
          <TextField source="firstname" />
          <EmailField source="email" />
          <TextField source="message" />
          <ShowButton />
        </Datagrid>
        )}
    />
  </List>
);

export default ContactList;

