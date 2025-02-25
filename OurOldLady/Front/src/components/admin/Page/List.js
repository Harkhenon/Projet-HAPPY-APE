import React from 'react';
import {
  List,
  Datagrid,
  TextField,
  ReferenceField,
  EditButton,
  Filter,
  ReferenceInput,
  SelectInput,
  TextInput,
  SimpleList,
  Responsive,
  ShowButton,
  RichTextField,
} from 'react-admin';

const ListFilter = props => (
  <Filter {...props}>
    <TextInput label="Search" source="q" alwaysOn />
    <ReferenceInput label="Title" source="title" reference="title" allowEmpty>
      <SelectInput optionText="lastname" />
    </ReferenceInput>
  </Filter>
);


const PageList = props => (
  <List filters={<ListFilter />} {...props}>
    <Responsive
      small={(
        <SimpleList
          primaryText={record => record.title}
          secondaryText={record => `${record.views} views`}
          tertiaryText={record => new Date(record.published_at).toLocaleDateString()}
        />
)}
      medium={(
        <Datagrid>
          <RichTextField source="title" />
          <EditButton />
          <ShowButton />
        </Datagrid>
)}
        />
  </List>
);

export default PageList;
