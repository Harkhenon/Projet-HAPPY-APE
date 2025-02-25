import React from 'react';
import {
  List,
  Datagrid,
  TextField,
  EmailField,
  UrlField,
  Filter,
  TextInput,
  ReferenceInput,
  SelectInput,
  SimpleList,
  Responsive,
  ShowButton,
  EditButton,
} from 'react-admin';

const UserFilter = props => (
  <Filter {...props}>
    <TextInput label="Search" source="q" alwaysOn />
    <ReferenceInput label="User" source="userId" reference="users" allowEmpty>
      <SelectInput optionText="name" />
    </ReferenceInput>
  </Filter>
);

const UserList = props => (
  <List filters={<UserFilter />} {...props}>
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
          <TextField source="id" />
          <TextField source="lastname" />
          <TextField source="firstname" />
          <TextField source="type" />
          <TextField source="role" />
          <EmailField source="email" />
          <EditButton />
          <ShowButton />
        </Datagrid>
        )}
    />
  </List>
);

export default UserList;

